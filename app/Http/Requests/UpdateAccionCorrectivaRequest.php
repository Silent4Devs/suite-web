<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAccionCorrectivaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('accion_correctiva_edit');
    }

    public function rules()
    {
        return [
            'fecharegistro' => [
                'date',
                'nullable',
            ],
            'fecha_compromiso' => [
                'date',
                'nullable',
            ],
            'fecha_verificacion' => [
                'date',
                'nullable',
            ],
        ];
    }
}
