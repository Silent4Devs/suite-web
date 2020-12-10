<?php

namespace App\Http\Requests;

use App\Models\GapDo;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreGapDoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('gap_do_create');
    }

    public function rules()
    {
        return [
            'anexo_indice'        => [
                'string',
                'nullable',
            ],
            'control'             => [
                'string',
                'nullable',
            ],
            'descripcion_control' => [
                'string',
                'nullable',
            ],
            'evidencia'           => [
                'string',
                'nullable',
            ],
            'recomendacion'       => [
                'string',
                'nullable',
            ],
        ];
    }
}
