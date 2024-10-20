<?php

namespace App\Api\Requests\SchoolRequests;

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
            'password' => 'required|string|min:8|max:100',
            'phone' => 'nullable|string|max:100',
            'address' => 'nullable|string|max:100',
            'established_year' => 'nullable|digits:4|integer|min:1900|max:' . date('Y'),
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'type' => 'required|in:primary,secondary,high_school',
            'organization_id' => 'nullable|exists:organizations,id',
        ];
    }


    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
        ], 422));
    }
}
