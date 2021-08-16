<?php

namespace App\Http\Requests;

use App\Models\MatrizRequisitoLegale;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

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
