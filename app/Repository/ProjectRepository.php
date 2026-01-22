<?php

namespace App\Repository;

use App\Models\Project;

class ProjectRepository
{
    public function getProjects()
    {
        return Project::get();
    }

    public function getProject($id)
    {
        return Project::find($id);
    }

    public function store($data)
    {
        return Project::create($data);
    }

    public function update($project, $data)
    {
        return $project->update($data);
    }

    public function delete($project)
    {
        return $project->delete();
    }
}
