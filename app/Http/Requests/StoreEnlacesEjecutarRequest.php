<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreEnlacesEjecutarRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('enlaces_ejecutar_create');
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
