<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class StorePlanBaseActividadeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('plan_base_actividade_create');
    }

    public function rules()
    {
        return [
            'actividad' => [
                'string',
                'required',
            ],
            'fecha_inicio' => [
                'date_format:'.config('panel.date_format'),
                'nullable',
            ],
            'fecha_fin' => [
                'date_format:'.config('panel.date_format'),
                'nullable',
            ],
            'compromiso' => [
                'date_format:'.config('panel.date_format'),
                'nullable',
            ],
            'real' => [
                'date_format:'.config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
