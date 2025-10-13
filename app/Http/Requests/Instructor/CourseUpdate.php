<?php

namespace App\Http\Requests\Instructor;

use Illuminate\Foundation\Http\FormRequest;

class CourseUpdate extends FormRequest
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
    public function rules()
    {
        $rules = [];

        $step = request()->query('step'); // هات step من الـ URL
        $this->dd($step);
        if ($step == 1) {
            $rules = [
                'title' => 'required|string|max:255',
                'seo_description' => 'nullable|string|max:255',
                'thumbnail' => 'nullable|file|max:2048',
                'demo_video_storage' => 'nullable|string|max:255',
                'demo_video_source' => 'nullable|file|max:2048',
                'price' => 'required|numeric|min:0',
                'discount' => 'nullable|numeric|min:0',
                'description' => 'nullable|string|max:255',
            ];
        } elseif ($step == 2) {
            $rules = [
                'capacity' => 'nullable|integer|min:1',
                'duration' => 'nullable|integer|min:1',
                'qna' => 'nullable|integer|min:0|max:1',
                'certificate' => 'nullable|integer|min:0|max:1',
                'category_id' => 'nullable|integer|min:1',
                'course_level' => 'nullable|integer|min:1',
                'course_language' => 'nullable|integer|min:1',
            ];
        }

        return $rules;
    }
}
