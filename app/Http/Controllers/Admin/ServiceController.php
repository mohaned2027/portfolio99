<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ServicesRequest;
use App\Services\Admin\ServicesService;

class ServiceController extends Controller
{
    protected $service;

    public function __construct(ServicesService $service)
    {
        $this->service = $service;
    }


    public function index(){
        $data = $this->service->getData();
        return response()->json([
            'services' => $data ,
        ],201);
    }

     public function store(ServicesRequest $data)
    {
        $service = $data->validated();
        $dataService = $this->service->storeData($service);

        return response()->json([
            'message' => 'Service created successfully',
            'service' => $dataService
        ], 201);
    }
}
