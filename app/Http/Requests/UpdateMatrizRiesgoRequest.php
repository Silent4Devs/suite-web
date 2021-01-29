<?php

namespace App\Http\Requests;

use App\Models\MatrizRiesgo;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMatrizRiesgoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('matriz_riesgo_edit');
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
            ],
            'integridad'           => [
                'string',
            ],
            'disponibilidad'       => [
                'string',
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
        ];
    }
}
