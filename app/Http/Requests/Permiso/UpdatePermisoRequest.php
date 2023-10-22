<?php

namespace App\Http\Requests\Permiso;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePermisoRequest extends FormRequest
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
            'nombre' => 'required|unique:permisos,nombre,'.$this->id,
            'slug' => 'required|unique:permisos,slug,'.$this->id
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
