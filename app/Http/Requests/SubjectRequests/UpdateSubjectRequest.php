<?php

namespace App\Http\Requests\SubjectRequests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubjectRequest extends FormRequest
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
            'description' => 'nullable|string',
            'grade_id' => 'required|exists:grades,id',
            'organization_id' => 'required|exists:organizations,id',
            'is_premium' => 'nullable|boolean',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => __('messages.name_is_required'),
            'name.string' => __('messages.name_must_be_a_string'),
            'name.max' => __('messages.name_must_be_less_than_255_characters'),
            'description.string' => __('messages.description_must_be_a_string'),
            'grade_id.required' => __('messages.grade_is_required'),
            'grade_id.exists' => __('messages.grade_must_exist'),
            'organization_id.required' => __('messages.organization_is_required'),
            'organization_id.exists' => __('messages.organization_must_exist'),
            'is_premium.boolean' => __('messages.is_premium_must_be_a_boolean'),
        ];
    }
}
