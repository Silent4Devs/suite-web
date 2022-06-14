<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateComunicacionSgiRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('comunicados_generales_editar');
    }

    public function rules()
    {
        return [
            'descripcion' => [
                'string',
                'required',
            ],
        ];
    }
}
