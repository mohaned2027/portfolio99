<?php

namespace App\Repository;

use App\Models\Education;

class EducationRepository
{


    public function getEducations()
    {
        return Education::get();
    }

    public function getEducation($id){
        return Education::find($id);
    }

    public function store($data)
    {
        return Education::create($data);
    }

    public function update($education, $data)
    {
        return $education->update($data);
    }

    public function delete($education)
    {
        return $education->delete();
    }
}
