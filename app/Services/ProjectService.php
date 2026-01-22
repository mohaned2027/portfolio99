<?php

namespace App\Services;

use App\Repository\ProjectRepository;

class ProjectService
{
    public function __construct(protected ProjectRepository $projectRepository) {}

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
        return $this->projectRepository->store($data);
    }

    public function update($data, $id)
    {
        $project = $this->projectRepository->getProject($id);
        if (!$project) return false;
        return $this->projectRepository->update($project, $data);
    }

    public function delete($id)
    {
        $project = $this->projectRepository->getProject($id);
        if (!$project) return false;
        return $this->projectRepository->delete($project);
    }
}
