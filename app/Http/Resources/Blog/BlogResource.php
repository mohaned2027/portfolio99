<?php

namespace App\Http\Resources\Blog;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class BlogResource extends JsonResource
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
            'category' => $this->category,
            'date' => $this->date?->toDateString(),
            'image' => $this->image
                ? Storage::disk('s3')->url($this->image)
                : null,
            'excerpt' => $this->excerpt,
            'content' => $this->content,
            'link' => $this->link,
        ];
    }
}
