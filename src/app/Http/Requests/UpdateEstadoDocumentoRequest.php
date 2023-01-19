<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEstadoDocumentoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('estado_documento_edit');
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
