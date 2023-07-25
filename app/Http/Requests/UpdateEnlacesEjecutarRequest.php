<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEnlacesEjecutarRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('enlaces_ejecutar_edit');
    }

    public function rules()
    {
        return [
            'ejecutar' => [
                'string',
                'nullable',
            ],
            'descripcion' => [
                'string',
                'nullable',
            ],
            'enlace' => [
                'string',
                'nullable',
            ],
        ];
    }
}
