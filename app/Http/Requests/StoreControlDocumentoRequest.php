<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreControlDocumentoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('control_documento_create');
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
                'date_format:'.config('panel.date_format'),
                'nullable',
            ],
            'version' => [
                'string',
                'nullable',
            ],
        ];
    }
}
