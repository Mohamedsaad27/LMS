<?php

namespace App\Http\Requests\RoleRequest;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleRequest extends FormRequest
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
            'id' => 'required|exists:roles,id',
            'name' => 'required|max:60|unique:roles,name,' . $this->route('role')->id,
            'permissions' => 'nullable',
            'permissions.*' => 'exists:permissions,name',
            'add_permissions' => 'nullable|array',
            'add_permissions.*' => 'exists:permissions,name',
        ];
    }
}
