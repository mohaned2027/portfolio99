<?php

namespace App\Services;

use App\Repository\ProjectRepository;
use App\Utils\ImageManager;
use Illuminate\Http\UploadedFile;

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
            $data['images'] = array_values($data['images']);

        }

        // Image Cover
        if (! isset($data['image_cover']) && ! empty($data['images'])) {
            $data['image_cover'] = $data['images'][0];
        }

        if (isset($data['image_cover']) && $data['image_cover'] instanceof UploadedFile) {
            $data['image_cover'] = $this->imageManager->uploadSingleImage($data['image_cover'], 'project', 'store');
            if (! $data['image_cover']) {
                return false;
            }
        }

        $project = $this->projectRepository->store($data);

        if (! $project) {
            return false;
        }

        $teams = $data['teams'] ?? [];
        $projectTeams = $this->projectRepository->createProjectTeams($project, $teams);

        if (! $projectTeams) {
            return false;
        }

        $dataProject = $project->fresh('teams')->load('teams');

        return $dataProject;

    }

    public function update($data, $id)
    {
        $project = $this->projectRepository->getProject($id);
        if (! $project) {
            return false;
        }

        // =========================
        // 1) Old images from request (strings)
        // =========================
        $oldImagesFromRequest = $data['images'] ?? null;

        // لو الفرونت مش باعت images خالص، يبقى حافظ على اللي في DB
        $oldImages = is_array($oldImagesFromRequest) ? $oldImagesFromRequest : ($project->images ?? []);
        if (! is_array($oldImages)) {
            $oldImages = [];
        }

        // نظّف القيم الفاضية
        $oldImages = array_values(array_filter($oldImages, fn ($v) => is_string($v) && trim($v) !== ''));

        // =========================
        // 2) Upload new files (images_files[])
        // =========================
        $newImages = [];
        if (isset($data['images_files']) && is_array($data['images_files'])) {
            foreach ($data['images_files'] as $file) {
                if ($file instanceof UploadedFile) {
                    $path = $this->imageManager->uploadSingleImage($file, 'projects', 'store');
                    if (! $path) {
                        return false;
                    }
                    $newImages[] = $path;
                }
            }
        }

        // =========================
        // 3) Optional: delete removed images from storage
        // (يحذف الصور اللي كانت في DB واتشالت من UI)
        // =========================
        if (is_array($oldImagesFromRequest)) {
            $current = is_array($project->images) ? $project->images : [];
            $toDelete = array_diff($current, $oldImages); // اللي اتشال من الواجهة
            if (! empty($toDelete)) {
                $this->imageManager->deleteImageFromLocal(array_values($toDelete));
            }
        }

        // =========================
        // 4) Merge (no override)
        // old + new  (الجديد يتضاف آخر الليست)
        // =========================
        $finalImages = array_values(array_merge($oldImages, $newImages));

        $data['images'] = $finalImages;

        // cover = أول صورة
        if (! empty($finalImages)) {
            $data['image_cover'] = $finalImages[0];

            // لو cover اتغير احذف القديم
            if ($project->image_cover && $project->image_cover !== $data['image_cover']) {
                $this->imageManager->deleteImageFromLocal($project->image_cover);
            }
        }

        // مهم: شيل images_files من data لأنها مش column في DB
        unset($data['images_files']);

        // =========================
        // 5) Update record
        // =========================
        $updated = $this->projectRepository->update($project, $data);
        if (! $updated) {
            return false;
        }

        // =========================
        // 6) Sync teams لو موجودة
        // =========================
        // لو teams_present موجودة يبقى لازم sync حتى لو teams فاضية
        if (array_key_exists('teams_present', $data)) {
            $teams = $data['teams'] ?? [];
            $teams = is_array($teams) ? $teams : [];
            $project->teams()->sync($teams); // [] => يمسح الكل
        }

        return true;
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
