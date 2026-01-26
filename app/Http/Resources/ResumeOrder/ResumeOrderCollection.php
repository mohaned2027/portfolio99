<?php

namespace App\Http\Resources\ResumeOrder;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ResumeOrderCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $resumeOrder = $this->collection->first();

        return [
            'order' => $resumeOrder ? $resumeOrder->order : [],
        ];
    }
}
