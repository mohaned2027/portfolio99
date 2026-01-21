<?php

namespace App\Services\Admin;

use App\Repository\Admin\ServicesRepository;

class ServicesService
{
    /**
     * Create a new class instance.
     */
    protected $service;
    public function __construct(ServicesRepository $services)
    {
        $this->service = $services;
    }

    public function getData()
    {
        return  $this->service->getData();
    }

    public function storeData($data){
        return $this->service->storeData($data);
    }
}
