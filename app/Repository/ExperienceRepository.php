<?php

namespace App\Repository;

use App\Models\Experience;

class ExperienceRepository
{
  public function getExperiences()
    {
        return Experience::get();
    }

    public function getExperience($id){
        return Experience::find($id);
    }

    public function store($data)
    {
        return Experience::create($data);
    }

    public function update($experience, $data)
    {
        return $experience->update($data);
    }

    public function delete($experience)
    {
        return $experience->delete();
    }
}
