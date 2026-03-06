<?php

namespace App\Http\Requests\User;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'title' => 'required|string|min:3|max:255',
            'avatar' => 'required|file|max:2048',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->user()?->id),
            ],
            'contact_email' => [
                'required',
                'email',
                Rule::unique('users', 'contact_email')->ignore($this->user()?->id),
            ],
            'phone' => 'required|string|min:6|max:30',
            'location' => 'required|string|min:2|max:255',
            'birthday' => 'required|date',
            'about' => 'required|string|min:3',
            'map_embed' => 'required|string',
            'social_links' => 'required|array',
            'password' => 'required|string|min:8',
        ];

        if ($this->method() === 'PUT') {
            $data = [
                'name' => 'sometimes|string|min:3|max:255',
                'title' => 'sometimes|string|min:3|max:255',
                'avatar' => 'sometimes|file|max:2048',
                'email' => [
                    'sometimes',
                    'email',
                    Rule::unique('users', 'email')->ignore($this->user()?->id),
                ],
                'contact_email' => [
                    'sometimes',
                    'email',
                    Rule::unique('users', 'contact_email')->ignore($this->user()?->id),
                ],
                'phone' => 'sometimes|string|min:6|max:30',
                'birthday' => 'sometimes|date',
                'location' => 'sometimes|string|min:2|max:255',
                'about' => 'sometimes|string|min:3',
                'map_embed' => 'sometimes|string',
                'social_links' => 'sometimes|array',
                'password' => 'sometimes|string|min:8',
            ];
        }

        return $data;
    }
}
