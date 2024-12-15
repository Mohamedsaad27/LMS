<?php

namespace App\Http\Requests\UnitRequests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUnitRequest extends FormRequest
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
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'description_ar' => 'nullable|string|max:255',
            'description_en' => 'nullable|string|max:255',
            'grade_id' => 'required|exists:grades,id',
            'subject_id' => 'required|exists:subjects,id',
        ];
    }
    public function messages(): array
    {
        return [
            'name_ar.required' => trans('validation.required'),
            'name_ar.max' => trans('validation.max'),
            'name_en.required' => trans('validation.required'),
            'name_en.max' => trans('validation.max'),
            'description_ar.max' => trans('validation.max'),
            'description_en.max' => trans('validation.max'),
            'grade_id.required' => trans('validation.required'),
            'subject_id.required' => trans('validation.required'),
            'grade_id.exists' => trans('validation.exists'),
            'subject_id.exists' => trans('validation.exists'),
        ];
    }
}

