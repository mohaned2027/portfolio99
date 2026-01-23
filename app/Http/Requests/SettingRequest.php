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
            'logo' => 'required|image|max:500',
            'favicon' => 'required|image|max:500',
            'cv' => 'required|file|mimes:pdf|max:50000',
        ];

        if ($this->method() == 'PUT') {
            $data['company'] = 'sometimes|string|min:2|max:255';
            $data['logo'] = 'sometimes|image|max:500';
            $data['favicon'] = 'sometimes|image|max:500';
            $data['cv'] = 'sometimes|file|mimes:pdf|max:2048';
        }

        return $data;
    }
}
