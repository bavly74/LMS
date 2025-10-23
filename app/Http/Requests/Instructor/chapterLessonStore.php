<?php

namespace App\Http\Requests\Instructor;

use Illuminate\Foundation\Http\FormRequest;

class chapterLessonStore extends FormRequest
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
        $rules = [];
        $rules['title'] = ['required', 'string', 'max:255'];
        $rules['description'] = ['nullable', 'string'];
        $rules['storage'] = ['required', 'in:'.implode(',',array_keys(config('course.storages', [])))];
        $rules['duration'] = ['required', 'string', 'max:255'];
        $rules['file_type'] = ['required', 'in:'.implode(',', array_keys(config('course.file_type', [])))];
        $rules['is_preview']= ['nullable','boolean'];
        $rules['is_downloadable']=['nullable','boolean'];
    
        if($this->get('storage') === 'upload'){
            $rules['file_path'] = ['required', 'string', 'max:255'];
        }else{
            $rules['url'] = ['required', 'url', 'max:255'];
        }
        return $rules;
        
    }
}
