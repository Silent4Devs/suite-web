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
            'id_sede' => [
                'required',
                'int',
            ],
            'id_proceso' => [
                'required',
                'int',
            ],
            'activo_id' => [
                'required',
                'int',
            ],
            'id_responsable' => [
                'required',
                'int',
            ],
            'id_amenaza'=> [
                'required',
                'int',
            ],
            'id_vulnerabilidad'=> [
                'required',
                'int',
            ],
            'controles_id'=> [
                'required',
                'array',
            ],
            'confidencialidad'=> [
                'required',
            ],
            'integridad'=> [
                'required',
            ],
            'disponibilidad'=> [
                'required',
            ],
            'probabilidad'=> [
                'required',
                'int',
            ],
            'impacto'=> [
                'required',
                'int',
            ],
        ];
    }
}
