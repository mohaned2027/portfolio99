<?php

namespace App\Repository;

use App\Models\ResumeOrder;

class ResumeOrderRepository
{
    public function getResumeOrders()
    {
        return ResumeOrder::get();
    }

    public function getResumeOrder()
    {
        return ResumeOrder::first();
    }

    public function update($resumeOrder, $data)
    {
        return $resumeOrder->update($data);
    }
}
