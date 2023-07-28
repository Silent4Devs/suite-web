<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateGapUnoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('gap_uno_edit');
    }

    public function rules()
    {
        return [
            'pregunta' => [
                'string',
                'nullable',
            ],
            'evidencia' => [
                'string',
                'nullable',
            ],
            'recomendacion' => [
                'string',
                'nullable',
            ],
        ];
    }
}
