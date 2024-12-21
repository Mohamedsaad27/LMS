<?php

namespace App\Http\Requests\ClassRoomRequests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClassRoomRequest extends FormRequest
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
            'capacity' => 'required|integer|max:255',
            'description' => 'nullable|string|max:255',
            'grade_id' => 'required|exists:grades,id',
            'school_id' => 'required|exists:schools,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'name.string' => 'Name Must be charachter only',
            'name.max' => 'Name Must be less than 255 charachters',
            'capacity.required' => 'The capacity field is required.',
            'capacity.integer' => 'The capacity field must be an integer.',
            'capacity.max' => 'The capacity field must be less than 255.',
            'grade_id.required' => 'The grade field is required.',
            'grade_id.exists' => 'The selected grade does not exist.',
            'school_id.required' => 'The school field is required.',
            'school_id.exists' => 'The selected school does not exist.',
        ];
    }
}
