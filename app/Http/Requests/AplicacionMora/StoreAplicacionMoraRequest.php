<?php

namespace App\Http\Requests\AplicacionMora;

use Illuminate\Foundation\Http\FormRequest;

class StoreAplicacionMoraRequest extends FormRequest
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
            'nombre' => 'required|unique:aplicacion_moras,nombre'
        ];
    }

    public function messages(): array
    {
        return [
            'required' => '* Campo obligatorio',
            'unique' => 'El nombre ya existe'
        ];
    }
}
