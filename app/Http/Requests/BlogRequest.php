<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
            'category' => 'required|string|min:2|max:255',
            'date' => 'required|date',
            'image' => 'required|string|max:255',
            'excerpt' => 'required|string|min:3|max:255',
            'content' => 'required|string|min:3|max:255',
            'link' => 'required|string|min:3|max:255',
        ];

        if ($this->method() == 'PUT') {
            $data['title'] = 'sometimes|string|min:3|max:255';
            $data['category'] = 'sometimes|string|min:2|max:255';
            $data['date'] = 'sometimes|date';
            $data['image'] = 'sometimes|string|max:255';
            $data['excerpt'] = 'sometimes|string|min:3|max:255';
            $data['content'] = 'sometimes|string|min:3|max:255';
            $data['link'] = 'sometimes|string|min:3|max:255';
        }

        return $data;
    }
}
