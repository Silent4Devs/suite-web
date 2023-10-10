<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTratamientoRiesgoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('tratamiento_de_los_riesgos_editar');
    }

    public function rules()
    {
        return [
            'nivelriesgo' => [
                'string',
                'nullable',
            ],
            'fechacompromiso' => [
                'date:',
                'nullable',
            ],
            'estatus' => [
                'string',
                'nullable',
            ],
            'probabilidad' => [
                'string',
                'nullable',
            ],
            'impacto' => [
                'string',
                'nullable',
            ],
            'nivelriesgoresidual' => [
                'string',
                'nullable',
            ],
        ];
    }
}
