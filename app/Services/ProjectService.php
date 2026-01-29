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
        // Handle images array (could be files or strings if copied, but usually files in store)
        if (isset($data['images']) && is_array($data['images'])) {
            $uploadedImages = [];
            foreach ($data['images'] as $image) {
                if ($image instanceof UploadedFile) {
                    $path = $this->imageManager->uploadSingleImage($image, 'projects', 'store');
                    if ($path) {
                        $uploadedImages[] = $path;
                    }
                }
            }
            $data['images'] = $uploadedImages;
        }

        // Set image_cover to the first image if not provided
        if (!isset($data['image_cover']) && !empty($data['images'])) {
            $data['image_cover'] = $data['images'][0];
        }

        $project = $this->projectRepository->store($data);

        if (!$project) {
            return false;
        }

        $teams = $data['teams'] ?? [];
        $this->projectRepository->createProjectTeams($project, $teams);

        return $project->fresh(['teams', 'service']);
    }

    public function update($data, $id)
    {
        $project = $this->projectRepository->getProject($id);
        if (!$project) {
            return false;
        }

        // 1. Get existing images from request (these are the ones the user kept)
        $keptImages = $data['images'] ?? [];
        if (!is_array($keptImages)) {
            $keptImages = [];
        }
        // Filter out empty strings or non-string values
        $keptImages = array_values(array_filter($keptImages, fn($v) => is_string($v) && trim($v) !== ''));

        // 2. Upload new image files
        $newImages = [];
        if (isset($data['images_files']) && is_array($data['images_files'])) {
            foreach ($data['images_files'] as $file) {
                if ($file instanceof UploadedFile) {
                    $path = $this->imageManager->uploadSingleImage($file, 'projects', 'store');
                    if ($path) {
                        $newImages[] = $path;
                    }
                }
            }
        }

        // 3. Delete removed images from storage
        $currentImages = is_array($project->images) ? $project->images : [];
        $removedImages = array_diff($currentImages, $keptImages);
        if (!empty($removedImages)) {
            $this->imageManager->deleteImageFromLocal(array_values($removedImages));
        }

        // 4. Merge kept and new images
        $finalImages = array_values(array_merge($keptImages, $newImages));
        $data['images'] = $finalImages;

        // 5. Update image_cover (always the first image in the array)
        if (!empty($finalImages)) {
            $newCover = $finalImages[0];
            
            // If cover changed, we might want to delete the old cover if it's not in the new images list
            // But since image_cover is usually one of the images in the 'images' array, 
            // the deletion logic in step 3 already handles it.
            $data['image_cover'] = $newCover;
        } else {
            $data['image_cover'] = null;
        }

        // Remove images_files as it's not a DB column
        unset($data['images_files']);

        // 6. Update project record
        $updated = $this->projectRepository->update($project, $data);
        if (!$updated) {
            return false;
        }

        // 7. Sync teams
        if (array_key_exists('teams', $data)) {
            $teams = is_array($data['teams']) ? $data['teams'] : [];
            $teams = array_values(array_filter($teams, fn($v) => is_numeric($v)));
            $project->teams()->sync($teams);
        }

        return true;
    }

    public function delete($id)
    {
        $project = $this->projectRepository->getProject($id);
        if (!$project) {
            return false;
        }

        if ($project->images) {
            $this->imageManager->deleteImageFromLocal($project->images);
        }
        if ($project->image_cover) {
            $this->imageManager->deleteImageFromLocal($project->image_cover);
        }

        return $this->projectRepository->delete($project);
    }
}
