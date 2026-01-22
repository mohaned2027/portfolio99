<?php

namespace App\Repository;

use App\Models\Service;

class ServicesRepository
{
    /**
     * Create a new class instance.
     */
    protected $services;
    public function __construct(Service $services)
    {
        $this->services = $services;
    }

    public function getData(){
        return $this->services->get();
    }

    public function storeData($data){
        return $this->services->create($data);
    }

}
