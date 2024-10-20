<?php

namespace App\Api\Requests\OrganizationRequests;

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
            'password' => 'nullable|string|min:3|max:255',
            'phone' => 'nullable|string|min:3|max:255',
            'description_en' => 'nullable|string|min:3|max:255',
            'description_ar' => 'nullable|string|min:3|max:255',
            'address' => 'nullable|string|min:3|max:255',
            'logo' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg',
            'established_year' => 'nullable|date',
        ];
    }


    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->errorResponse($validator->errors(),422));
    }
}
