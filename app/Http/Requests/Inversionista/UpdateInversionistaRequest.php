<?php

namespace App\Http\Requests\Inversionista;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInversionistaRequest extends FormRequest
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
            'numero_documento' => 'required',
            'nombres' => 'required|string|max:191',
            'apellido_paterno' => 'required|string|max:191',
            'apellido_materno' => 'required|string|max:191',
            'sexo_id' => 'required',
            'name' => 'required',
            'email' => 'email:filter',
            'role_id' => 'required'
        ];
    }

    /**
     * get the validation messages that applt to the request
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function messages()
    {
        return [
            'required' => '* Campo obligatorio',
            'unique' => 'Ya existe',
            'string' => 'Ingrese caracteres alfanuméricos',
            'max' => 'Ingrese máximo :max carateres',
            'email' => 'Email no válido'
        ];
    }
}
