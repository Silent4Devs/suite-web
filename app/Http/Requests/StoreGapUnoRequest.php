<?php

namespace App\Http\Requests;

use App\Models\GapUno;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreGapUnoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('gap_uno_create');
    }

    public function rules()
    {
        return [
            'pregunta'      => [
                'string',
                'nullable',
            ],
            'evidencia'     => [
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
