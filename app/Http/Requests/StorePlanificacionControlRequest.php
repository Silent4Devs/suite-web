<?php

namespace App\Http\Requests;

use App\Models\PlanificacionControl;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePlanificacionControlRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('planificacion_control_create');
    }

    public function rules()
    {
        return [
            'activo'           => [
                'string',
                'required',
            ],
            'vulnerabilidad'   => [
                'string',
                'nullable',
            ],
            'amenaza'          => [
                'string',
                'nullable',
            ],
            'confidencialidad' => [
                'string',
                'nullable',
            ],
            'integridad'       => [
                'string',
                'nullable',
            ],
            'disponibilidad'   => [
                'string',
                'nullable',
            ],
            'probabilidad'     => [
                'string',
                'nullable',
            ],
            'impacto'          => [
                'string',
                'nullable',
            ],
            'nivelriesgo'      => [
                'string',
                'nullable',
            ],
        ];
    }
}
