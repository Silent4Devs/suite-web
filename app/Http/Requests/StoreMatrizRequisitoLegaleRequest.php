<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMatrizRequisitoLegaleRequest extends FormRequest
{
    public function rules()
    {
        return [
            'nombrerequisito' => [
                'string',
                'required',
            ],
            'fechaexpedicion' => [
                'date',
                'nullable',
            ],
            'fechavigor' => [
                'date',
                'nullable',
            ],
            'requisitoacumplir' => [
                'string',
                'nullable',
            ],
            'formacumple' => [
                'string',
                'nullable',
            ],
            'periodicidad_cumplimiento' => [
                'string',
                'nullable',
            ],
            'fechaverificacion' => [
                'date',
                'nullable',
            ],
        ];
    }
}
