<?php

namespace App\Http\Requests\SchoolRequests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreSchoolRequest extends FormRequest
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
            'name_en' => 'required|string|max:100',
            'name_ar' => 'required|string|max:100',
            'email' => 'required|email|unique:schools,email|max:100',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'password' => 'required|string|min:8|max:100',
            'phone' => 'nullable|string|max:100|unique:schools,phone|max:100',
            'address' => 'nullable|string|max:100',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'type' => 'required|in:primary,secondary,high_school',
            'organization_id' => 'nullable|exists:organizations,id',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name_en.required' => 'The English name is required.',
            'name_ar.required' => 'The Arabic name is required.',
            'email.required' => 'The email is required.',
            'password.required' => 'The password is required.',
            'type.required' => 'The type is required.',
            'organization_id.exists' => 'The organization must exist.',
            'email.unique' => 'The email must be unique.',
            'phone.unique' => 'The phone must be unique.',
            'logo.image' => 'The logo must be an image.',
            'logo.mimes' => 'The logo must be a valid image format (jpeg, png, jpg, gif, svg).',
            'logo.max' => 'The logo must be less than 2MB in size.',
            
        ];
    }
}
