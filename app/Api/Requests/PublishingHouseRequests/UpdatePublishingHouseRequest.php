<?php

namespace App\Api\Requests\PublishingHouseRequests;

use App\Traits\ApiResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdatePublishingHouseRequest extends FormRequest
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
            'established_year' => ['nullable', 'integer'],
            'description' => ['nullable', 'string'],
            'total_books' => ['nullable', 'integer', 'min:1'],
        ];
    }
    public function messages()
    {

    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->errorResponse($validator->errors(),422));
    }
}
