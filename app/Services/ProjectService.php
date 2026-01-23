<?php

namespace App\Services;

use App\Repository\ProjectRepository;
use App\Utils\ImageManager;

class ProjectService
{
    public function __construct(protected ProjectRepository $projectRepository, protected ImageManager $imageManager) {}

    public function getProjects()
    {
        return $this->projectRepository->getProjects();
    }

    public function getProject($id)
    {
        return $this->projectRepository->getProject($id) ?? false;
    }

    public function store($data)
    {
        // Image Cover Upload
        if (isset($data['images'])) {
            foreach ($data['images'] as $key => $image) {
                $data['images'][$key] = $this->imageManager->uploadSingleImage($image, 'projects', 'store');
                if (! $data['images'][$key]) {
                    return false;
                }
            }

        }

        // Image Cover
        if (isset($data['image_cover'])) {
            $data['image_cover'] = $this->imageManager->uploadSingleImage($data['image_cover'], 'project', 'store');
            if (! $data['image_cover']) {
                return false;
            }
        }

        return $this->projectRepository->store($data);
    }

    public function update($data, $id)
    {
        $project = $this->projectRepository->getProject($id);
        if (! $project) {
            return false;
        }

        if (isset($data['images'])) {
            foreach ($data['images'] as $key => $image) {
                $data['images'][$key] = $this->imageManager->uploadSingleImage($image, 'projects', 'store', $project->images);
                if (! $data['images'][$key]) {
                    return false;
                }
            }

        }

        // Image Cover
        if (isset($data['image_cover'])) {
            $data['image_cover'] = $this->imageManager->uploadSingleImage($data['image_cover'], 'project', 'store', $project->image_cover);
            if (! $data['image_cover']) {
                return false;
            }
        }

        return $this->projectRepository->update($project, $data);
    }

    public function delete($id)
    {
        $project = $this->projectRepository->getProject($id);
        if (! $project) {
            return false;
        }

        $this->imageManager->deleteImageFromLocal($project->images);
        $this->imageManager->deleteImageFromLocal($project->image_cover);

        return $this->projectRepository->delete($project);
    }
}
