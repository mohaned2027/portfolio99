<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamRequest;
use App\Http\Resources\Team\TeamCollection;
use App\Http\Resources\Team\TeamResource;
use App\Services\TeamService;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(protected TeamService $teamService) {}
    public function index()
    {
        $data = $this->teamService->getTeams();

        if ($data->isEmpty()) {
            return apiResponce(404, 'Not Found');
        }

        return apiResponce(200, 'Success', new TeamCollection($data));
    }

    public function store(TeamRequest $request)
    {
        $data = $request->validated();

        $team = $this->teamService->store($data);

        if (!$team) {
            return apiResponce(400, 'Bad Request');
        }

        return apiResponce(200, 'Success', TeamResource::make($team));
    }

    public function update(TeamRequest $request, $id)
    {
        $data = $request->validated();

        if (!$this->teamService->update($data, $id)) {
            return apiResponce(400, 'Bad Request');
        }

        $team = $this->teamService->getTeam($id);

        if (!$team) {
            return apiResponce(404, 'Not Found');
        }
        return apiResponce(200, 'Success', TeamResource::make($team));
    }

    public function destroy($id)
    {
        if (!$this->teamService->delete($id)) {
            return apiResponce(400, 'Bad Request');
        }

        return apiResponce(200, 'Success');
    }
}
