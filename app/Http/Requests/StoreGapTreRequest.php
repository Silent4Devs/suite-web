<?php

namespace App\Http\Requests;

use App\Models\GapTre;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreGapTreRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('gap_tre_create');
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
