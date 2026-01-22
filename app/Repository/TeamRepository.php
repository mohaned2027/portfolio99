<?php

namespace App\Repository;

use App\Models\Team;

class TeamRepository
{
    public function getTeams()
    {
        return Team::get();
    }

    public function getTeam($id)
    {
        return Team::find($id);
    }

    public function store($data)
    {
        return Team::create($data);
    }

    public function update($team, $data)
    {
        return $team->update($data);
    }

    public function delete($team)
    {
        return $team->delete();
    }
}
