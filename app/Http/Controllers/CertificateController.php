<?php

namespace App\Http\Controllers;

use App\Http\Requests\CertificationRequest;
use App\Http\Resources\Certification\CertificationCollection;
use App\Http\Resources\Certification\CertificationResource;
use App\Services\CertificationService;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(protected CertificationService $certificationService) {}
    public function index()
    {
        $data = $this->certificationService->getCertifications();

        if ($data->isEmpty()) {
            return apiResponce(404, 'Not Found');
        }

        return apiResponce(200, 'Success', new CertificationCollection($data));
    }

    public function store(CertificationRequest $request)
    {
        $data = $request->validated();

        $certification = $this->certificationService->store($data);

        if (!$certification) {
            return apiResponce(400, 'Bad Request');
        }

        return apiResponce(200, 'Success', CertificationResource::make($certification));
    }

    public function update(CertificationRequest $request, $id)
    {
        $data = $request->validated();

        if (!$this->certificationService->update($data, $id)) {
            return apiResponce(400, 'Bad Request');
        }

        $certification = $this->certificationService->getCertification($id);

        if (!$certification) {
            return apiResponce(404, 'Not Found');
        }
        return apiResponce(200, 'Success', CertificationResource::make($certification));
    }

    public function destroy($id)
    {
        if (!$this->certificationService->delete($id)) {
            return apiResponce(400, 'Bad Request');
        }

        return apiResponce(200, 'Success');
    }
}
