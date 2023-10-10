<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMatrizRiesgoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('iso_27001_editar');
    }

    public function rules()
    {
        return [
            'proceso' => [
                'string',
                'nullable',
            ],
            'responsableproceso' => [
                'string',
                'nullable',
            ],
            'amenaza' => [
                'string',
                'nullable',
            ],
            'vulnerabilidad' => [
                'string',
                'nullable',
            ],
            'descripcionriesgo' => [
                'string',
                'nullable',
            ],
            'confidencialidad' => [
                'string',
            ],
            'integridad' => [
                'string',
            ],
            'disponibilidad' => [
                'string',
            ],
            'nivelriesgo' => [
                'numeric',
            ],
            'riesgototal' => [
                'numeric',
            ],
            'resultadoponderacion' => [
                'numeric',
            ],
            'riesgoresidual' => [
                'numeric',
            ],
            'justificacion' => [
                'string',
                'nullable',
            ],
        ];
    }
}
