<?php

namespace App\Http\Requests\OrganizationRequests;

use App\Traits\ApiResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateOrganizationRequest extends FormRequest
{
    use ApiResponseTrait;
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
            'name_en' => 'nullable|string|min:3|max:255',
            'name_ar' => 'nullable|string|min:3|max:255',
            'email' => 'nullable|string|min:3|max:255',
            'phone' => 'nullable|string|min:3|max:255',
            'description_en' => 'nullable|string|min:3|max:255',
            'description_ar' => 'nullable|string|min:3|max:255',
            'address' => 'nullable|string|min:3|max:255',
            'logo' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg',
            'established_year' => 'nullable|numeric|digits:4',
        ];
    }
    public function messages(): array
    {
        return [
            'name_en.string' => 'English name must be a string.',
            'name_ar.string' => 'Arabic name must be a string.',
            'email.string' => 'Email must be a string.',
            'phone.string' => 'Phone number must be a string.',
            'description_en.string' => 'English description must be a string.',
            'description_ar.string' => 'Arabic description must be a string.',
            'address.string' => 'Address must be a string.',
            'logo.file' => 'Logo must be a file.',
            'logo.mimes' => 'Logo must be an image file with the following extensions: jpeg, png, jpg, gif, svg.',
            'name_en.min' => 'English name must be at least 3 characters.',
            'name_en.max' => 'English name must be at most 255 characters.',
            'name_ar.min' => 'Arabic name must be at least 3 characters.',
            'name_ar.max' => 'Arabic name must be at most 255 characters.',
            'email.email' => 'Email must be a valid email address.',
            'phone.min' => 'Phone number must be at least 3 characters.',
            'phone.max' => 'Phone number must be at most 255 characters.',
            'description_en.min' => 'English description must be at least 3 characters.',
            'description_en.max' => 'English description must be at most 255 characters.',
            'description_ar.min' => 'Arabic description must be at least 3 characters.',
            'description_ar.max' => 'Arabic description must be at most 255 characters.',
            'address.min' => 'Address must be at least 3 characters.',
            'address.max' => 'Address must be at most 255 characters.',
        ];
    }


}
