<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResumeOrderRequest;
use App\Http\Resources\ResumeOrder\ResumeOrderCollection;
use App\Http\Resources\ResumeOrder\ResumeOrderResource;
use App\Services\ResumeOrderService;

class ResumeOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(protected ResumeOrderService $resumeOrderService) {}

    public function index()
    {
        $data = $this->resumeOrderService->getResumeOrders();

        if ($data->isEmpty()) {
            return apiResponce(404, 'Not Found');
        }

        return apiResponce(200, 'Success', new ResumeOrderCollection($data));
    }

    public function update(ResumeOrderRequest $request )
    {
        $data = $request->validated();
        $id = auth()->user()->id;

        if (! $this->resumeOrderService->update($data, $id)) {
            return apiResponce(400, 'Bad Request');
        }
        $resumeOrder = $this->resumeOrderService->getResumeOrder($id);

        if (! $resumeOrder) {
            return apiResponce(404, 'Not Found');
        }

        return apiResponce(200, 'Success', ResumeOrderResource::make($resumeOrder));
    }
}
