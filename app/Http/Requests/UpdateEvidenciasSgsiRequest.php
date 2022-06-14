<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEvidenciasSgsiRequest extends FormRequest
{
    

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
                // 'date_format:' . config('panel.date_format'),
                'date',
                'nullable',
            ],
        ];
    }
}
