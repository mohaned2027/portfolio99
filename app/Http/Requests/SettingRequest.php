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
            'logo' => 'required|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'favicon' => 'required|image|mimes:jpg,jpeg,png,webp,svg,ico|max:2048',
            'cv' => 'required|file|mimes:pdf|max:10240',
        ];

        if ($this->method() == 'PUT') {
            $data['company'] = 'sometimes|string|min:2|max:255';
            $data['logo'] = 'sometimes|image|mimes:jpg,jpeg,png,webp,svg|max:2048';
            $data['favicon'] = 'sometimes|image|mimes:jpg,jpeg,png,webp,svg,ico|max:2048';
            $data['cv'] = 'sometimes|file|mimes:pdf|max:10240';
        }

        return $data;
    }
}
