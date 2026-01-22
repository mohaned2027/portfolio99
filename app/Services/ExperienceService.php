<?php

namespace App\Services;

use App\Repository\ExperienceRepository;

class ExperienceService
{

 public function __construct(protected ExperienceRepository $experienceRepository) {}

    public function getExperiences()
    {
        return $this->experienceRepository->getExperiences();
    }

    public function getExperience($id)
    {
        return $this->experienceRepository->getExperience($id) ?? false ;
    }

    public function store($data)
    {
        return $this->experienceRepository->store($data);
    }

    public function update($data, $id)
    {
        $experience = $this->experienceRepository->getExperience($id);
        if(!$experience) return false;
        return $this->experienceRepository->update($experience, $data);
    }

    public function delete($id)
    {
        $experience = $this->experienceRepository->getExperience($id);
        if(!$experience) return false;
        return $this->experienceRepository->delete($experience);
    }

}
