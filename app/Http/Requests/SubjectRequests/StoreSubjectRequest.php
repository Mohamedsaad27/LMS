<?php

namespace App\Http\Requests\SubjectRequests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubjectRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'grade_id' => 'required|exists:grades,id',
            'organization_id' => 'required|exists:organizations,id',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.string' => 'Name Must be charachter only',
            'name.max' => 'Name Must be less than 255 charachter',
            'description.string' => 'Description Must be charachter only',
            'description.max' => 'Description Must be less than 255 charachter',
            'grade_id.required' => 'The grade field is required.',
            'grade_id.exists' => 'The grade field is not valid.',
            'organization_id.required' => 'The organization field is required.',
            'organization_id.exists' => 'The organization field is not valid.',            
        ];      
    }
}
