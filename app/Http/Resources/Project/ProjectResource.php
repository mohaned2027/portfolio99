<?php

namespace App\Http\Resources\Project;

use App\Http\Resources\Team\TeamResource;
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
            'image_cover' => secure_asset($this->image_cover),
            'images' => collect($this->images)->map(fn ($img) => secure_asset($img)),
            // 'images' => array_map(fn ($img) => asset($img), $this->images),
            'link' => $this->link,
            'github' => $this->github,
            'technologies' => $this->technologies,
            'status' => $this->status,
            // 'teams' => $this->whenLoaded('teams', fn () => TeamResource::collection($this->teams->pluck('id'))),
            'team_members' => $this->whenLoaded('teams', fn () => $this->teams->pluck('id')),
            'service_id' => $this->whenLoaded('service', fn () => $this->service->id),
        ];
    }
}
