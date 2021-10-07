<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMatrizRequisitoLegaleRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('matriz_requisito_legale_edit');
    }

    public function rules()
    {
        return [
            'nombrerequisito'           => [
                'string',
                'required',
            ],
            'fechaexpedicion'           => [
                'date',
                'nullable',
            ],
            'fechavigor'                => [
                'date',
                'nullable',
            ],
            'requisitoacumplir'         => [
                'string',
                'nullable',
            ],
            'formacumple'               => [
                'string',
                'nullable',
            ],
            'periodicidad_cumplimiento' => [
                'string',
                'nullable',
            ],
            'fechaverificacion'         => [
                'date',
                'nullable',
            ],
        ];
    }
}
