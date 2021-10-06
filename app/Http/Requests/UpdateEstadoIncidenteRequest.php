<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEstadoIncidenteRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('estado_incidente_edit');
    }

    public function rules()
    {
        return [
            'estado' => [
                'string',
                'required',
            ],
        ];
    }
}
