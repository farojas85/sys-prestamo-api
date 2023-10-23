<?php

namespace App\Http\Requests\Moneda;

use Illuminate\Foundation\Http\FormRequest;

class StoreMonedaRequest extends FormRequest
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
            'codigo'    => 'required|string|max:3|unique:monedas,codigo',
            'nombre'    => 'required|string|max:191|unique:monedas,nombre',
            'pais'      => 'required|string|max:191|unique:monedas,pais'
        ];
    }

    /**
     * @return [type]
     */
    public function messages()
    {
        return [
            'required'  => '* Dato Obligatorio',
            'unique'    => '* Ya existe el mismo dato',
            'max'       => '* Ingrese Máximo :max caracteres',
            'string'    => '* Ingrese caracteres alfanuméricos',
            'numeric'    => '* Ingrese solo numeros'
        ];
    }
}
