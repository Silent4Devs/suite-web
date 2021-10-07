<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreRecursoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('recurso_create');
    }

    public function rules()
    {
        return [
            'tipo' => [
                'required',
            ],
            'fecha_curso' => [
                'date',
                'required',
            ],
            'fecha_fin' => [
                'date',
                'required',
            ],
            'instructor' => [
                'string',
                'required',
            ],
            'cursoscapacitaciones' => [
                'string',
                'required',
            ],
            'ubicacion' => [
                'string',
                'required',
            ],
            'categoria_capacitacion_id' => [
                'string',
                'required',
            ],
            'modalidad' => [
                'string',
                'required',
            ],

        ];
    }
}
