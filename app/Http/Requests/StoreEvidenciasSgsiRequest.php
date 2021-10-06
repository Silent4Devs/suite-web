<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreEvidenciasSgsiRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('evidencias_sgsi_create');
    }

    public function rules()
    {
        return [
            'objetivodocumento' => [
                'string',
                'required',
            ],
            'arearesponsable'   => [
                'string',
                'nullable',
            ],
            'fechadocumento'    => [
                'date',
                'nullable',
            ],
        ];
    }
}
