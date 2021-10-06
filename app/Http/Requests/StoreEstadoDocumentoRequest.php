<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreEstadoDocumentoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('estado_documento_create');
    }

    public function rules()
    {
        return [
            'estado' => [
                'string',
                'nullable',
            ],
        ];
    }
}
