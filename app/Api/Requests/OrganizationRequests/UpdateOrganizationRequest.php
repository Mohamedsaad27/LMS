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
            'logo' => ['nullable', 'image', 'mimes:jpg,png,jpeg', 'max:2048'],
            'established_year' => ['nullable', 'date'],
            'description_ar' => ['nullable', 'string'],
            'description_en' => ['nullable', 'string'],
            'total_books' => ['nullable', 'integer', 'min:1'],
        ];
    }


    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->errorResponse($validator->errors(),422));
    }
}