<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $data = [
            'title' => 'nullable|string|min:3|max:255',
            'short_desc' => 'nullable|string|min:3|max:255',
            'desc' => 'nullable|string|min:3',
            'image_cover' => 'nullable|image|max:255',
            'images' => 'nullable|array',
            'link' => 'nullable|string|max:255',
            'github' => 'nullable|string|max:255',
            'technologies' => 'nullable|array',
            'status' => 'nullable|boolean',
            'team_id' => 'nullable|integer|exists:teams,id',
            'service_id' => 'nullable|integer|exists:services,id',
        ];

        if ($this->method() == 'PUT') {
            $data['title'] = 'sometimes|string|min:3|max:255';
            $data['short_desc'] = 'sometimes|string|min:3|max:255';
            $data['desc'] = 'sometimes|string|min:3';
            $data['image_cover'] = 'sometimes|image|max:255';
            $data['images'] = 'sometimes|array';
            $data['link'] = 'sometimes|nullable|string|max:255';
            $data['github'] = 'sometimes|nullable|string|max:255';
            $data['technologies'] = 'sometimes|array';
            $data['status'] = 'sometimes|nullable|boolean';
            $data['team_id'] = 'sometimes|nullable|integer|exists:teams,id';
            $data['service_id'] = 'sometimes|nullable|integer|exists:services,id';
        }

        return $data;
    }
}
