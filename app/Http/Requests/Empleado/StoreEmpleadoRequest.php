<?php

namespace App\Http\Requests\Empleado;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmpleadoRequest extends FormRequest
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
            'tipo_documento_id' => 'required',
            'numero_documento' => 'required|unique:personas,numero_documento',
            'nombres' => 'required|string|max:191',
            'apellido_paterno' => 'required|string|max:191',
            'apellido_materno' => 'required|string|max:191',
            'sexo_id' => 'required',
            'name' => 'required|string|max:191|unique:users,name',
            'email' => 'email:filter|unique:users,email',
            'role_id' => 'required',
            'password' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'required' => '* Campo obligatorio',
            'uniqque' => 'Ya existe',
            'string' => 'Ingrese caracteres alfanuméricos',
            'max' => 'Ingrese máximo :max carateres',
            'email' => 'Email no válido'
        ];
    }
}
