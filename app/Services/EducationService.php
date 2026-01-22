<?php

namespace App\Services;

use App\Repository\EducationRepository;

class EducationService
{

    public function __construct(protected EducationRepository $educationRepository) {}

    public function getEducations()
    {
        return $this->educationRepository->getEducations();
    }

    public function getEducation($id)
    {
        return $this->educationRepository->getEducation($id) ?? false;
    }

    public function store($data)
    {
        return $this->educationRepository->store($data);
    }

    public function update($data, $id)
    {
        $education = $this->educationRepository->getEducation($id);
        if (!$education) return false;
        return $this->educationRepository->update($education, $data);
    }

    public function delete($id)
    {
        $education = $this->educationRepository->getEducation($id);
        if (!$education) return false;
        return $this->educationRepository->delete($education);
    }
}
