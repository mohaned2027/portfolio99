<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeamRequest extends FormRequest
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
            'name' => 'required|string|min:2|max:255',
            'track' => 'required|string|min:2|max:255',
            'logo' => 'nullable|string|max:255',
            'url' => 'required|string|max:255',
        ];

        if ($this->method() == 'PUT') {
            $data['name'] = 'sometimes|string|min:2|max:255';
            $data['track'] = 'sometimes|string|min:2|max:255';
            $data['logo'] = 'sometimes|nullable|string|max:255';
            $data['url'] = 'sometimes|string|max:255';
        }

        return $data;
    }
}
