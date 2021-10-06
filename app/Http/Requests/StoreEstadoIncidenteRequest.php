<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreEstadoIncidenteRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('estado_incidente_create');
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
