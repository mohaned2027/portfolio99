<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SkillService;
use App\Http\Requests\SkillRequest;
use App\Http\Resources\Skill\SkillCollection;
use App\Http\Resources\Skill\SkillResources;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(protected SkillService $skillService) {}
    public function index()
    {
        $data = $this->skillService->getSkills();

        if ($data->isEmpty()) {
            return apiResponce(404, 'Not Found');
        }

        return apiResponce(200, 'Success', new SkillCollection($data));
    }

    public function store(SkillRequest $request)
    {
        $data = $request->validated();

        $skill = $this->skillService->store($data);

        if (!$skill) {
            return apiResponce(400, 'Bad Request');
        }

        return apiResponce(200, 'Success',  SkillResources::make($skill));
    }


    public function update(SkillRequest $request,  $id)
    {

        $data = $request->validated();

        if (!$this->skillService->update($data, $id)) {
            return apiResponce(400, 'Bad Request');
        }

        $skill = $this->skillService->getSkill($id);

        if (!$skill) {
            return apiResponce(404, 'Not Found');
        }
        return apiResponce(200, 'Success',  SkillResources::make($skill));
    }

    public function destroy($id)
    {

        if (!$this->skillService->delete($id)) {
            return apiResponce(400, 'Bad Request');
        }

        return apiResponce(200, 'Success');
    }
}
