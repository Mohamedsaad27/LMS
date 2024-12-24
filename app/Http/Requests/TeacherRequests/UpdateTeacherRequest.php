<?php

namespace App\Http\Requests\TeacherRequests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTeacherRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Assuming the user is authorized to make this request
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->teacher->user->id,
            'phone' => 'required|string|max:255',
            'password' => 'nullable|string|min:8',
            'address' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'date_of_birth' => 'required|date',
            'hire_date' => 'required|date',
            'qualification' => 'nullable|string|max:255', 
            'experience_years' => 'nullable|integer|min:0', 
            'school_id' => 'nullable|exists:schools,id',
            'grades' => 'nullable|array',
            'grades.*' => 'nullable|integer|exists:grades,id',
            'subjects' => 'nullable|array',
            'subjects.*' => 'nullable|integer|exists:subjects,id',
            'salary' => 'nullable|numeric', 
            'status' => 'nullable|in:active,inactive',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }
}
