<?php

namespace App\Http\Requests\Menu;

use Illuminate\Foundation\Http\FormRequest;

class StoreMenuRequest extends FormRequest
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
            'nombre'     => 'required|max:191|unique:menus,nombre',
            'slug'       => 'required|max:191|unique:menus,slug',
            'icono'      => 'required|max:191'
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
            'number'    => '* Ingrese solo numeros'
        ];
    }
}
