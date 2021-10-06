<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreAuditoriaAnualRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('auditoria_anual_create');
    }

    public function rules()
    {
        return [
            'tipo'        => [
                'required',
            ],
            'fechainicio' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'dias'        => [
                'numeric',
                'min:1',
                'max:100',
            ],
        ];
    }
}
