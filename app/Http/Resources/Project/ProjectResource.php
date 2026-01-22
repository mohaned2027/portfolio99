<?php

namespace App\Http\Resources\Project;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'short_desc' => $this->short_desc,
            'desc' => $this->desc,
            'image_cover' => $this->image_cover,
            'images' => $this->images,
            'link' => $this->link,
            'github' => $this->github,
            'technologies' => $this->technologies,
            'status' => $this->status,
            'team_id' => $this->team_id,
            'service_id' => $this->service_id,
        ];
    }
}
