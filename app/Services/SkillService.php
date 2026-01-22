<?php

namespace App\Services;

use App\Repository\SkillRepository;


class SkillService
{


    public function __construct(protected SkillRepository $skillRepository) {}

    public function getSkills()
    {
        return $this->skillRepository->getSkills();
    }

    public function getSkill($id)
    {
        return $this->skillRepository->getSkill($id) ?? false;
    }

    public function store($data)
    {
        return $this->skillRepository->store($data);
    }

    public function update($data, $id)
    {
        $education = $this->skillRepository->getSkill($id);
        if (!$education) return false;
        return $this->skillRepository->update($education, $data);
    }

    public function delete($id)
    {
        $education = $this->skillRepository->getSkill($id);
        if (!$education) return false;
        return $this->skillRepository->delete($education);
    }
}
