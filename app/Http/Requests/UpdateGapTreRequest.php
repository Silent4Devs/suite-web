<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateGapTreRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('gap_tre_edit');
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
