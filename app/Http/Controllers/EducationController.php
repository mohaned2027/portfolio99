<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\EducationService;
use App\Http\Requests\EducationRequest;
use App\Http\Resources\Education\EducationResource;
use App\Http\Resources\Education\EducationCollection;

class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(protected EducationService $educationService) {}
    public function index()
    {
        $data = $this->educationService->getEducations();

        if ($data->isEmpty()) {
            return apiResponce(404, 'Not Found');
        }

        return apiResponce(200, 'Success', new EducationCollection($data));
    }

    public function store(EducationRequest $request)
    {
        $data = $request->validated();

        $education = $this->educationService->store($data);

        if (!$education) {
            return apiResponce(400, 'Bad Request');
        }

        return apiResponce(200, 'Success',  EducationResource::make($education));
    }


    public function update(EducationRequest $request,  $id)
    {

        $data = $request->validated();

        if (!$this->educationService->update($data, $id)) {
            return apiResponce(400, 'Bad Request');
        }

        $education = $this->educationService->getEducation($id);

        if (!$education) {
            return apiResponce(404, 'Not Found');
        }
        return apiResponce(200, 'Success',  EducationResource::make($education));
    }

    public function destroy($id)
    {

        if (!$this->educationService->delete($id)) {
            return apiResponce(400, 'Bad Request');
        }

        return apiResponce(200, 'Success');
    }
}
