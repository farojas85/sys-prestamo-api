<?php

namespace App\Http\Requests\Desembolso;

use Illuminate\Foundation\Http\FormRequest;

class StoreDesembolsoRequest extends FormRequest
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
            'cliente_cuenta_id' => 'required',
            'fecha_desembolso' => 'required',
            'numero_operacion' => 'required',
            'fecha_deposito' => 'required',
            'imagen_voucher' => 'required'
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function messages(): array
    {
        return [
            'required' => '* Campo Obligatorio'
        ];
    }
}
