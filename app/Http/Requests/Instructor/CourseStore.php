<?php

namespace App\Http\Requests\Instructor;

use Illuminate\Foundation\Http\FormRequest;

class CourseStore extends FormRequest
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
            'title' => 'required|string|max:255',
            'seo_description' => 'nullable|string|max:255',
            'thumbnail' => 'nullable|file|max:2048',
            'demo_video_storage' => 'nullable|string|max:255',
            'demo_video_source' => 'nullable',
            'price'=>'required|numeric|min:0',
            'discount'=>'nullable|numeric|min:0',
            'description'=>'nullable|string|max:255',
            'url'=>'nullable|url',
        ];
    }
}
