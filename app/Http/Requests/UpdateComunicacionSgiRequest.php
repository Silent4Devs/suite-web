<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateComunicacionSgiRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('comunicacion_sgi_edit');
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
