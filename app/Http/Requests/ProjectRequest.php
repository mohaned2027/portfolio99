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
            'title' => 'require|string|min:3|max:255',
            'short_desc' => 'require|string|min:3|max:255',
            'desc' => 'require|string|min:3',
            'image_cover' => 'require|image|max:255',
            'images' => 'require|array',
            'link' => 'require|string|max:255',
            'github' => 'require|string|max:255',
            'technologies' => 'require|array',
            'status' => 'require|boolean',
            'teams' => 'require|array',
            'service_id' => 'require|integer|exists:services,id',
        ];

        if ($this->method() == 'PUT') {
            $data['title'] = 'sometimes|string|min:3|max:255';
            $data['short_desc'] = 'sometimes|string|min:3|max:255';
            $data['desc'] = 'sometimes|string|min:3';
            $data['image_cover'] = 'sometimes|image|max:255';
            $data['images'] = 'sometimes|array';
            $data['link'] = 'sometimes|string|max:255';
            $data['github'] = 'sometimes|string|max:255';
            $data['technologies'] = 'sometimes|array';
            $data['status'] = 'sometimes|boolean';
            $data['teams'] = 'sometimes|array';
            $data['teams.*'] = 'sometimes|integer|exists:teams,id';
            $data['service_id'] = 'sometimes|integer|exists:services,id';
        }

        return $data;
    }
}
