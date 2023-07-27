<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreGapUnoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('gap_uno_create');
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
