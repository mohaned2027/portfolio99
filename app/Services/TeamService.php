<?php

namespace App\Services;

use App\Repository\TeamRepository;

class TeamService
{
    public function __construct(protected TeamRepository $teamRepository) {}

    public function getTeams()
    {
        return $this->teamRepository->getTeams();
    }

    public function getTeam($id)
    {
        return $this->teamRepository->getTeam($id) ?? false;
    }

    public function store($data)
    {
        return $this->teamRepository->store($data);
    }

    public function update($data, $id)
    {
        $team = $this->teamRepository->getTeam($id);
        if (!$team) return false;
        return $this->teamRepository->update($team, $data);
    }

    public function delete($id)
    {
        $team = $this->teamRepository->getTeam($id);
        if (!$team) return false;
        return $this->teamRepository->delete($team);
    }
}
