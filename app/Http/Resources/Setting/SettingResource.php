<?php

namespace App\Http\Resources\Setting;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class SettingResource extends JsonResource
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
            'company' => $this->company,
            'logo' =>  $this->logo
                ? Storage::disk('s3')->url($this->logo)
                : null,
            'favicon' =>  $this->favicon
                ? Storage::disk('s3')->url($this->favicon)
                : null,
            'cv' =>  $this->cv
                ? Storage::disk('s3')->url($this->cv)
                : null,
        ];
    }
}
