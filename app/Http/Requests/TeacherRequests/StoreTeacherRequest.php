<?php

namespace App\Http\Requests\TeacherRequests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Teacher;

class StoreTeacherRequest extends FormRequest
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
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'school_id' => 'required|integer|exists:schools,id',
            'grades' => 'nullable|array',
            'grades.*' => 'nullable|integer|exists:grades,id',
            'subjects' => 'nullable|array',
            'subjects.*' => 'nullable|integer|exists:subjects,id',
            'gender' => 'required|in:male,female',
            'date_of_birth' => 'required|date',
            'hire_date' => 'required|date',
            'qualification' => 'nullable|string|max:255',
            'experience_years' => 'required|integer|min:0',
            'status' => 'required|in:active,inactive',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'salary' => 'required|numeric'
        ];
    }
}
