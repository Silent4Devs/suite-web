<?php

namespace App\Http\Requests;

use App\Models\EstadoIncidente;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

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
