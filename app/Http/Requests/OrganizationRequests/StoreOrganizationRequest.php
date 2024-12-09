<?php

namespace App\Http\Requests\OrganizationRequests;

use App\Traits\ApiResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;


class StoreOrganizationRequest extends FormRequest
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
            'name_en' => ['required', 'string', 'max:255'],
            'name_ar' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255','unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'address' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255','unique:users'],
            'logo' => ['nullable', 'image', 'mimes:jpg,png,jpeg', 'max:2048'],
            'established_year' => ['nullable', 'integer'],
            'description_ar' => ['nullable', 'string'],
            'description_en' => ['nullable', 'string'],
            'max_schools' => ['nullable', 'integer', 'min:1'],
        ];
    }
    public function messages(): array
    {
        return [
            'name_en.required' => 'The English name is required.',
            'name_ar.required' => 'The Arabic name is required.',
            'email.required' => 'The email address is required.',
            'email.unique' => 'This email is already in use.',
            'password.required' => 'The password is required.',
            'password.min' => 'The password must be at least 8 characters.',
            'gender.in' => 'The gender must be either male or female.',
            'phone.unique' => 'This phone number is already in use.',
            'logo.image' => 'The logo must be an image.',
            'logo.mimes' => 'The logo must be a file of type: jpg, png, jpeg.',
            'logo.max' => 'The logo may not be greater than 2048 kilobytes.',
            'established_year.integer' => 'The established year must be a valid year.',
            'description_ar.string' => 'The Arabic description must be a string.',
            'description_en.string' => 'The English description must be a string.',
            'max_schools.integer' => 'The maximum number of schools must be a valid number.',
            'max_schools.min' => 'The maximum number of schools must be at least 1.',
        ];
    }
  
}
