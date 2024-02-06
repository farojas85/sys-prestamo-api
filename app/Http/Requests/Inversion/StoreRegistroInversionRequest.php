<?php

namespace App\Http\Requests\Inversion;

use Illuminate\Foundation\Http\FormRequest;

class StoreRegistroInversionRequest extends FormRequest
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
            'fecha' => 'required',
            'inversionista_id' => 'required',
            'monto' => 'required|numeric',
            'tasa_interes' => 'required|numeric'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function messages(): array
    {
        return [
            'required' => '* Campo obligatorio',
            'numeric' => 'Ingrese solo números'
        ];
    }
}
