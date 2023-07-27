<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class StorePlanAuditoriumRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('plan_de_auditoria_agregar');
    }

    public function rules()
    {
        return [
            'equipoauditor' => [
                'string',
                'nullable',
            ],
            'auditados.*' => [
                'integer',
            ],
            'auditados' => [
                'array',
            ],
        ];
    }
}
