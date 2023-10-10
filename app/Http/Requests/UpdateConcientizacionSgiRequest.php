<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateConcientizacionSgiRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('concientizacion_sgsi_editar');
    }

    public function rules()
    {
        return [
            'objetivocomunicado' => [
                'string',
                'required',
            ],
            'fecha_publicacion' => [
                'date',
                'required',
            ],
            'personalobjetivo' => [
                'string',
                'required',
            ],
            'arearesponsable_id' => [
                'required',
            ],
            'medio_envio' => [
                'required',
            ],
        ];
    }
}
