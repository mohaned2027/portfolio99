<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'company' => 'required|string|min:2|max:255',
            'logo' => 'required|string|max:255',
            'favicon' => 'required|string|max:255',
            'cv' => 'required|string|max:255',
        ];

        if ($this->method() == 'PUT') {
            $data['company'] = 'sometimes|string|min:2|max:255';
            $data['logo'] = 'sometimes|string|max:255';
            $data['favicon'] = 'sometimes|string|max:255';
            $data['cv'] = 'sometimes|string|max:255';
        }

        return $data;
    }
}
