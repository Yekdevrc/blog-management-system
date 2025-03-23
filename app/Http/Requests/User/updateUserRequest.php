<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class updateUserRequest extends FormRequest
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
        return [
            'name'=> ['required', 'string', 'max:100'],
            'email'=> ['required', 'email'],
            'password'=> ['required', 'confirmed', 'max:16', 'min:6'],
            'profile_picture'=> ['nullable', 'image', 'mimes:png,jpg,jpeg', 'max:1024']
        ];
    }
    public function messages()
    {
        return [
            "profile_picture.max"=> "Profile Picture should be under 1 GB size."
        ];
    }
}
