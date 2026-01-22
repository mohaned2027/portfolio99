<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SkillRequest extends FormRequest
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
        $data =
            [
                'name' => 'required|string',
                'percentage' => 'required|integer|between:10,100',
            ];

        if ($this->method() == 'PUT') {
            $data['name'] = 'sometimes|string|min:3|max:255';
            $data['percentage'] = 'sometimes|integer|between:10,100';
        }

        return $data;
    }
}
