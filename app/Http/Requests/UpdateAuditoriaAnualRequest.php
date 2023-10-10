<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAuditoriaAnualRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('programa_anual_auditoria_editar');
    }

    public function rules()
    {
        return [
            'tipo' => [
                'required',
            ],
            'fechainicio' => [
                'required',
            ],
            'dias' => [
                'numeric',
                'min:1',
                'max:100',
            ],
        ];
    }
}
