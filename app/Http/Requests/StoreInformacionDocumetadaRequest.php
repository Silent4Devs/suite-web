<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreInformacionDocumetadaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('informacion_documetada_create');
    }

    public function rules()
    {
        return [
            'titulodocumento' => [
                'string',
                'required',
            ],
            'identificador' => [
                'string',
                'nullable',
            ],
            'version' => [
                'numeric',
                'min:1',
                'max:99',
            ],
            'politicas.*' => [
                'integer',
            ],
            'politicas' => [
                'array',
            ],
        ];
    }
}
