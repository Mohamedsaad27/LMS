<?php

namespace App\Api\Requests\StudentRequests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
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
            'email' => 'required|string|email|unique:users,email',
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
            'name_en.required' => 'English name is required.',
            'name_ar.required' => 'Arabic name is required.',
            'email.required' => 'Email is required.',
            'email.email' => 'Invalid email format.',
            'email.unique' => 'Email already exists.',
            'password.required' => 'Password is required.',
            'password.max' => 'Password must not be more than 255 characters.',
            'gender.in' => 'Gender must be male or female.',
            'address.max' => 'Address must not be more than 255 characters.',
            'phone.max' => 'Phone must not be more than 255 characters.',
            'school_id.required' => 'School is required.',
            'school_id.exists' => 'School does not exist.',
            'date_of_birth.required' => 'Date of birth is required.',
            'date_of_birth.date' => 'Invalid date of birth format.',
            'parent_contact.max' => 'Parent contact must not be more than 255 characters.',
            'photo.image' => 'File must be an image.',
            'photo.mimes' => 'Photo must be a file of type: jpeg, png, jpg, gif, svg.',
            'photo.max' => 'Photo size must not be more than 2048 kilobytes.',
            'grade_id.required' => 'Grade is required.',
            'grade_id.exists' => 'Grade does not exist.',
        ];
    }
}
