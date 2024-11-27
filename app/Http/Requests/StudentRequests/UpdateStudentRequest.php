<?php

namespace App\Http\Requests\StudentRequests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
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
            'email' => 'required|string|email|unique:users,email,' . $this->route('user'),
            'password' => 'required|string|max:255',
            'gender' => 'nullable|string|in:male,female',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'school_id' => 'required|string|max:255|exists:schools,id',
            'date_of_birth' => 'nullable|date',
            'parent_contact' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'grade_id' => 'required|string|exists:grades,id',
        ];
    }
    public function messages(): array
    {
        return [
            'email.unique' => 'Email already exists.',
            'name_en.required' => 'English name is required.',
            'name_ar.required' => 'Arabic name is required.',
            'email.required' => 'Email is required.',
            'email.email' => 'Invalid email format.',
            'password.required' => 'Password is required.',
            'password.max' => 'Password must not be more than 255 characters.',
            'gender.in' => 'Gender must be male or female.',
            'address.max' => 'Address must not be more than 255 characters.',
            'phone.max' => 'Phone must not be more than 255 characters.',
            'school_id.required' => 'School is required.',
            'grade_id.required' => 'Grade is required.',
            'grade_id.exists' => 'Grade does not exist.',
            'photo.image' => 'Photo must be an image.',
            'photo.mimes' => 'Photo must be a valid image format (jpeg, png, jpg, gif, svg).',
            'photo.max' => 'Photo must not be larger than 2MB.',
        ];
    }
}
