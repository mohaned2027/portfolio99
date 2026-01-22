<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExperienceRequest;
use App\Http\Resources\Experience\ExperienceCollection;
use App\Http\Resources\Experience\ExperienceResources;
use Illuminate\Http\Request;
use App\Services\ExperienceService;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(protected ExperienceService $experienceService) {}
    public function index()
    {
        $data = $this->experienceService->getExperiences();

        if ($data->isEmpty()) {
            return apiResponce(404, 'Not Found');
        }

        return apiResponce(200, 'Success', new ExperienceCollection($data));
    }

    public function store(ExperienceRequest $request)
    {
        $data = $request->validated();

        $experience = $this->experienceService->store($data);

        if (!$experience) {
            return apiResponce(400, 'Bad Request');
        }

        return apiResponce(200, 'Success',  ExperienceResources::make($experience));
    }


    public function update(ExperienceRequest $request,  $id)
    {

        $data = $request->validated();

        if (!$this->experienceService->update($data, $id)) {
            return apiResponce(400, 'Bad Request');
        }

        $experience = $this->experienceService->getExperience($id);

        if (!$experience) {
            return apiResponce(404, 'Not Found');
        }
        return apiResponce(200, 'Success',  ExperienceResources::make($experience));
    }

    public function destroy($id)
    {

        if (!$this->experienceService->delete($id)) {
            return apiResponce(400, 'Bad Request');
        }

        return apiResponce(200, 'Success');
    }
}
