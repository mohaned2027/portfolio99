<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'title' => 'required|string|min:3|max:255',

            'short_desc' => 'required|string|min:3|max:255',
            'desc' => 'required|string|min:3',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
            'link' => 'nullable|string|max:255',
            'github' => 'nullable|string|max:255',
            'technologies' => 'required|array',
            'technologies.*' => 'string',
            'status' => 'required|boolean',
            'teams' => 'nullable|array',
            'teams.*' => 'nullable|integer|exists:teams,id',
            'service_id' => 'required|integer|exists:services,id',
        ];

        if ($this->method() == 'PUT') {
            $data['title'] = 'sometimes|string|min:3|max:255';
          
            $data['short_desc'] = 'sometimes|string|min:3|max:255';
            $data['desc'] = 'sometimes|string|min:3';
            $data['image_cover'] = 'sometimes|image|mimes:jpg,jpeg,png,webp|max:2048';
            $data['images'] = 'sometimes|array';
            $data['images.*'] = 'nullable|string';

            $data['images_files'] = 'sometimes|array';
            $data['images_files.*'] = 'sometimes|image|mimes:jpg,jpeg,png,webp|max:2048';

            $data['link'] = 'nullable|string|max:255';
            $data['github'] = 'nullable|string|max:255';
            $data['technologies'] = 'sometimes|array';
            $data['technologies.*'] = 'sometimes|string';
            $data['status'] = 'sometimes|boolean';
            $data['teams_present'] = 'nullable|in:1';
            $data['teams'] = 'nullable|array';
            $data['teams.*'] = 'nullable|integer|exists:teams,id';
            $data['service_id'] = 'sometimes|integer|exists:services,id';
        }

        return $data;
    }
}
