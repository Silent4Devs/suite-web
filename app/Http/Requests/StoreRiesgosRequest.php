<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRiesgosRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    // public function authorize(): bool
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'titulo' => 'required|max:255',
            'fecha' => 'required|date',
            'ubicacion' => 'required|max:255',
            'descripcion' => 'required|max:550',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'titulo.required' => 'El campo título es obligatorio.',
            'titulo.max' => 'El campo título no puede exceder los 255 caracteres.',
            'fecha.required' => 'El campo fecha es obligatorio.',
            'fecha.date' => 'El campo fecha debe ser una fecha válida.',
            'ubicacion.required' => 'El campo ubicación es obligatorio.',
            'ubicacion.max' => 'El campo ubicación no puede exceder los 255 caracteres.',
            'descripcion.required' => 'El campo descripción es obligatorio.',
            'descripcion.max' => 'El campo descripción no puede exceder los 550 caracteres.',
        ];
    }
}
