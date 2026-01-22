<?php

namespace App\Repository;

use App\Models\Certification;

class CertificationRepository
{
    public function getCertifications()
    {
        return Certification::get();
    }

    public function getCertification($id)
    {
        return Certification::find($id);
    }

    public function store($data)
    {
        return Certification::create($data);
    }

    public function update($certification, $data)
    {
        return $certification->update($data);
    }

    public function delete($certification)
    {
        return $certification->delete();
    }
}
