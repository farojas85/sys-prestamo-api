<?php

namespace App\Http\Requests\Notificacion;

use Illuminate\Foundation\Http\FormRequest;

class StoreNotificacionRequest extends FormRequest
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
            'titulo' => 'required',
            'imagen' => 'required|mimes:png,jpg,jpeg,wepb',
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'required' => '* Campo obligatorio',
            'mimes' => 'Solo imágnes :mimes'
        ];
    }
}
