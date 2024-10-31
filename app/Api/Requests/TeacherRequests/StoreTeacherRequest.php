<?php

namespace App\Api\Requests\TeacherRequests;

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
            'user_id' => 'required|integer|exists:users,id',
            'school_id' => 'nullable|integer|exists:schools,id',
            'hire_date' => 'nullable|date',
            'qualification' => 'nullable|string|max:255',
            'experience_years' => 'required|integer|min:0',
            'status' => 'required|in:active,inactive',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'salary' => 'nullable|numeric', 
            'date_of_birth' => 'nullable|date',
        ];
    }
}
