<?php

namespace App\Services;

use App\Repository\TeamRepository;
use App\Utils\ImageManager;

class TeamService
{
    public function __construct(protected TeamRepository $teamRepository, protected ImageManager $imageManager) {}

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
        if (isset($data['logo'])) {
            $data['logo'] = $this->imageManager->uploadSingleImage($data['logo'], 'Teams', 'store');
            if (! $data['logo']) {
                return false;
            }
        }

        return $this->teamRepository->store($data);
    }

    public function update($data, $id)
    {
        $team = $this->teamRepository->getTeam($id);


        if (isset($data['logo'])) {
            $data['logo'] = $this->imageManager->uploadSingleImage($data['logo'], 'Teams', 'store', $team->logo);
            if (! $data['logo']) {
                return false;
            }
        }
        if (! $team) {
            return false;
        }

        return $this->teamRepository->update($team, $data);
    }

    public function delete($id)
    {
        $team = $this->teamRepository->getTeam($id);
        if (! $team) {
            return false;
        }
        $this->imageManager->deleteImageFromLocal($team->logo);

        return $this->teamRepository->delete($team);
    }
}
