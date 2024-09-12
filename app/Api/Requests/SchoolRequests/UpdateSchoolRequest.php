<?php

namespace App\Api\Requests\SchoolRequests;

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
        return [
            'established_year' => 'nullable|date',
            'description' => 'nullable|string|max:1000',
            'student_count' => 'nullable|integer|min:0',
            'teacher_count' => 'nullable|integer|min:0',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'type' => 'required|string|in:primary,secondary,high_school',
        ];
    }
    public function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->messages();
        $firstErrors = collect($errors)->map(function($messages) {
            return $messages[0];  // Get only the first error message
        });

        throw new HttpResponseException(
            response()->json([
                'message' => $firstErrors->first(), // Show only the first error globally
                'errors' => $firstErrors
            ], 422)
        );
    }

}
