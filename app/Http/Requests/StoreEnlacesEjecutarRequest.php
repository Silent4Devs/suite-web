<?php

namespace App\Http\Requests;

use App\Models\EnlacesEjecutar;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreEnlacesEjecutarRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('enlaces_ejecutar_create');
    }

    public function rules()
    {
        return [
            'ejecutar'    => [
                'string',
                'nullable',
            ],
            'descripcion' => [
                'string',
                'nullable',
            ],
            'enlace'      => [
                'string',
                'nullable',
            ],
        ];
    }
}
