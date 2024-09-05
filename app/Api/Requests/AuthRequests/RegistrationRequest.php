<?php

namespace App\Api\Requests\AuthRequests;

use App\Traits\ApiResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegistrationRequest extends FormRequest
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'user_type_id' => ['required', 'integer', 'exists:user_types,id'],
            'gender' => ['required', 'string','in:male,female'],
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255','unique:users'],
        ];
    }

    public function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException($this->errorResponse($validator->errors(),422));
    }
}
