<?php

namespace App\Http\Requests\Blogs;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogRequest extends FormRequest
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
            'title'=> ['required', 'string', 'max:255'],
            'content'=> ['required', 'string'],
            'image'=> ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'slug'=> ['required', 'string', 'max:100'],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Title is required',
            'content.required' => 'Content is required',
            'image.required' => 'Image is required',
            'image.max' => 'Image size should not be more than 2MB',
            'image.mimes' => 'Image should be of type jpeg, png, jpg',
            'slug.required' => 'Slug is required',
        ];
    }
}
