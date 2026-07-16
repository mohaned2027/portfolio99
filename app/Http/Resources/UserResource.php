<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'title' => $this->title,
            'avatar' => $this->avatar
                ? Storage::disk('s3')->url($this->avatar)
                : null,
            'contact_email' => $this->contact_email,
            'phone' => $this->phone,
            'birthday' => $this->birthday,
            'location' => $this->location,
            'about' => $this->about,
            'map_embed' => $this->map_embed,
            'social_links' => $this->social_links,
        ];
    }
}
