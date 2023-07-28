<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateControlDocumentoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('control_documento_edit');
    }

    public function rules()
    {
        return [
            'clave' => [
                'string',
                'nullable',
            ],
            'nombre' => [
                'string',
                'nullable',
            ],
            'fecha_creacion' => [
                'date',
                'nullable',
            ],
            'version' => [
                'string',
                'nullable',
            ],
        ];
    }
}
