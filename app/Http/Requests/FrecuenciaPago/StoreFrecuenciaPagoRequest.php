<?php

namespace App\Http\Requests\FrecuenciaPago;

use Illuminate\Foundation\Http\FormRequest;

class StoreFrecuenciaPagoRequest extends FormRequest
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
            'nombre' => 'required|unique:frecuencia_pagos,nombre',
            'dias' => 'required|numeric'
        ];
    }

    public function messages(): array
    {
        return [
            'required' => '* Campo obligatorio',
            'numeric' => 'Solo números',
            'unique' => 'El nombre ya existe'
        ];
    }
}
