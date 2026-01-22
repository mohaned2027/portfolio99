<?php

namespace App\Services;

use App\Repository\CertificationRepository;
use App\Utils\ImageManager;

class CertificationService
{
    public function __construct(
        protected CertificationRepository $certificationRepository,
        protected ImageManager $imageManager
    ) {}

    public function getCertifications()
    {
        return $this->certificationRepository->getCertifications();
    }

    public function getCertification($id)
    {
        return $this->certificationRepository->getCertification($id) ?? false;
    }

    public function store($data)
    {
        if (isset($data['image'])) {
            $data['image'] = $this->imageManager->uploadSingleImage($data['image'], 'certifications', 'store');
            if (! $data['image']) {
                return false;
            }
        }

        return $this->certificationRepository->store($data);
    }

    public function update($data, $id)
    {
        $certification = $this->certificationRepository->getCertification($id);
        if (! $certification) {
            return false;
        }

        return $this->certificationRepository->update($certification, $data);
    }

    public function delete($id)
    {
        $certification = $this->certificationRepository->getCertification($id);
        if (! $certification) {
            return false;
        }

        return $this->certificationRepository->delete($certification);
    }
}
