<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Http\Resources\Project\ProjectCollection;
use App\Http\Resources\Project\ProjectResource;
use App\Services\ProjectService;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(protected ProjectService $projectService) {}
    public function index()
    {
        $data = $this->projectService->getProjects();

        if ($data->isEmpty()) {
            return apiResponce(404, 'Not Found');
        }

        return apiResponce(200, 'Success', new ProjectCollection($data));
    }

    public function store(ProjectRequest $request)
    {
        $data = $request->validated();

        $project = $this->projectService->store($data);

        if (!$project) {
            return apiResponce(400, 'Bad Request');
        }

        return apiResponce(200, 'Success', ProjectResource::make($project));
    }

    public function update(ProjectRequest $request, $id)
    {
        $data = $request->validated();

        if (!$this->projectService->update($data, $id)) {
            return apiResponce(400, 'Bad Request');
        }

        $project = $this->projectService->getProject($id);

        if (!$project) {
            return apiResponce(404, 'Not Found');
        }
        return apiResponce(200, 'Success', ProjectResource::make($project));
    }

    public function destroy($id)
    {
        if (!$this->projectService->delete($id)) {
            return apiResponce(400, 'Bad Request');
        }

        return apiResponce(200, 'Success');
    }
}
