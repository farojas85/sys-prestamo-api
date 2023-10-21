<?php

namespace App\Http\Requests\Role;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => 'required|unique:tipo_accesos,nombre,'.$this->id,
            'slug' => 'required|unique:tipo_accesos,slug,'.$this->id,
            'tipo_acceso_id' => 'required'
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'required' => '* Campo obligatorio',
            'unique' => 'Ya existe el nombre de seguro'
        ];
    }
}
