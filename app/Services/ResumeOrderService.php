<?php

namespace App\Services;

use App\Repository\ResumeOrderRepository;

class ResumeOrderService
{
    public function __construct(protected ResumeOrderRepository $resumeOrderRepository) {}

    public function getResumeOrders()
    {
        return $this->resumeOrderRepository->getResumeOrders();
    }

    public function getResumeOrder()
    {
        return $this->resumeOrderRepository->getResumeOrder() ?? false;
    }

    public function update($data)
    {
        $resumeOrder = $this->resumeOrderRepository->getResumeOrder();
        if (! $resumeOrder) {
            return false;
        }

        return $this->resumeOrderRepository->update($resumeOrder, $data);
    }
}
