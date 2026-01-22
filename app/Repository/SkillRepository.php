<?php

namespace App\Repository;

use App\Models\Skill;

class SkillRepository
{

    public function getSkills()
    {
        return Skill::get();
    }

    public function getSkill($id)
    {
        return Skill::find($id);
    }

    public function store($data)
    {
        return Skill::create($data);
    }

    public function update($skill, $data)
    {
        return $skill->update($data);
    }

    public function delete($skill)
    {
        return $skill->delete();
    }
}
