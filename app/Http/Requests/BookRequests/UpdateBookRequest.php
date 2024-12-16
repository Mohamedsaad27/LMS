<?php

namespace App\Http\Requests\BookRequests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
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
            'subject_id' => 'required|exists:subjects,id',
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publication_year' => 'nullable|integer|min:1900|max:2024',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'subject_id.required' => 'The subject field is required.',
            'subject_id.exists' => 'The selected subject is invalid.',
            'title.required' => 'The title field is required.',
            'title.string' => 'The title must be a string.',
            'title.max' => 'The title may not be greater than 255 characters.',
            'author.required' => 'The author field is required.',
            'author.string' => 'The author must be a string.',
            'author.max' => 'The author may not be greater than 255 characters.',
            'publication_year.integer' => 'The publication year must be an integer.',
            'publication_year.min' => 'The publication year must be a value between 1900 and 2024.',
            'publication_year.max' => 'The publication year must be a value between 1900 and 2024.',
            'cover_image.image' => 'The cover image must be an image file.',
            'cover_image.mimes' => 'The cover image must be a file of type: jpeg, png, jpg, gif, svg.',
            'cover_image.max' => 'The cover image may not be greater than 2048 kilobytes.',
            'description.string' => 'The description must be a string.',
            'description.max' => 'The description may not be greater than 255 characters.',
        ];
    }
}
