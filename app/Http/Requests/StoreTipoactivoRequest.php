<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreTipoactivoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('configuracion_tipoactivo_create');
    }

    public function rules()
    {
        return [
            'tipo' => [
                'string',
                'required',
            ],
            'subtipo' => [
                'string',
                'required',
            ],
        ];
    }
}
