<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreComunicacionSgiRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('comunicacion_sgi_create');
    }

    public function rules()
    {
        return [
            'descripcion' => [
                'string',
                'required',
            ],
        ];
    }
}
