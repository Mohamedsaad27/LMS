<?php

namespace App\Api\Requests\GradeRequest;

use Illuminate\Foundation\Http\FormRequest;

class StoreGradeRequest extends FormRequest
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
            'name_en' => 'required|string|max:255|alpha',
            'name_ar' => 'required|string|max:255|alpha',
            'description_en' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'educational_stage_id' => 'required|integer|exists:educational_stages,id',
        ];
    }
}
