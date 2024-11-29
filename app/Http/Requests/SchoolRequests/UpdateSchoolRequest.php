<?php

namespace App\Http\Requests\SchoolRequests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateSchoolRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * Adjust the authorization logic based on your app's requirements.
     */
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        $schoolId = $this->route('school');

        return [
            'name_en' => 'nullable|string|max:100',
            'name_ar' => 'nullable|string|max:100',
            'email' => 'nullable|email|unique:schools,email,' . $schoolId,
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'phone' => 'nullable|string|max:100|unique:schools,phone,' . $schoolId,
            'address' => 'nullable|string|max:100',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'type' => 'nullable|in:primary,secondary,high_school',
            'organization_id' => 'nullable|exists:organizations,id',
        ];
    }
    public function messages(): array
    {
        return [
            'logo.max' => 'The logo may not be greater than 2 MB.',
            'email.unique' => 'The email has already been taken.',
            'phone.unique' => 'The phone number has already been taken.',
            'organization_id.exists' => 'The selected organization is invalid.',
            'type.in' => 'The selected type is invalid. Allowed types are: primary, secondary, high_school.',
            'logo.image' => 'The logo must be an image.',
            'logo.mimes' => 'The logo must be a file of type: jpeg, png, jpg, gif, svg.',
        ];
    }
}