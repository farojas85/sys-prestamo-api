<?php

namespace App\Http\Requests\Moneda;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMonedaRequest extends FormRequest
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
            'codigo'    => 'required|string|max:3|unique:monedas,codigo,'.$this->id,
            'nombre'    => 'required|string|max:191|unique:monedas,nombre,'.$this->id,
            'pais'      => 'required|string|max:191|unique:monedas,pais,'.$this->id,
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
