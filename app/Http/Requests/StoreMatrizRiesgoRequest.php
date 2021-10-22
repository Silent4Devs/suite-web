<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreMatrizRiesgoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('matriz_riesgo_create');
    }

    public function rules()
    {
        return [
            'proceso'              => [
                'string',
                'nullable',
            ],
            'responsableproceso'   => [
                'string',
                'nullable',
            ],
            'amenaza'              => [
                'string',
                'nullable',
            ],
            'vulnerabilidad'       => [
                'string',
                'nullable',
            ],
            'descripcionriesgo'    => [
                'string',
                'nullable',
            ],
            'confidencialidad'     => [
              'string',
              'nullable',
            ],
            'integridad'           => [
              'string',
              'nullable',
            ],
            'disponibilidad'       => [
              'string',
              'nullable',
            ],
            'nivelriesgo'          => [
                'numeric',
            ],
            'riesgototal'          => [
                'numeric',
            ],
            'resultadoponderacion' => [
                'numeric',
            ],
            'riesgoresidual'       => [
                'numeric',
            ],
            'justificacion'        => [
                'string',
                'nullable',
            ],
            'controles_id'         => [
                'required',
                'array',
            ],
        ];
    }
}
