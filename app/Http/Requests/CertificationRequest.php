<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CertificationRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:255',
            'image' => 'nullable|image',
            'text' => 'required|string|min:3',
            'date' => 'nullable|date',
            'order' => 'nullable|integer|min:0',
        ];

        if ($this->method() == 'PUT') {
            $data['name'] = 'sometimes|string|min:3|max:255';
            $data['image'] = 'sometimes|string|max:500';
            $data['text'] = 'sometimes|string|min:3';
            $data['date'] = 'sometimes|date';
            $data['order'] = 'sometimes|integer|min:0';
        }

        return $data;
    }
}
