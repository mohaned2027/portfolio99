<?php

namespace App\Http\Resources\Experience;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ExperienceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
     public function toArray(Request $request): array
    {
        return [
            'experiences' => ExperienceResources::collection($this->collection),
            'count' => $this->count(),
        ];
    }
}
