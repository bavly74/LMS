<?php

namespace App\Http\Requests\Instructor;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProfileUpdate extends FormRequest
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
            'name' => 'required|string|max:255|min:3',
            'email' => 'required|email|unique:users,email,' . Auth::guard('instructor')->id(),
            'headline' => 'nullable|string',
            'bio' => 'nullable|string',
            'gender' => 'nullable|in:male,female',
            'facebook' => 'nullable|url',
            'x' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'github' => 'nullable|url',
            'website' => 'nullable|url',
            'password'=>'nullable|min:8|confirmed',
        ];
    }
}
