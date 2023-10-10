<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrganizacionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('organizacion_create');
    }

    public function rules()
    {
        return [
            'empresa' => [
                'string',
                'required',
            ],
            'direccion' => [
                'required',
            ],
            'telefono' => [
                'nullable',
                'string',
                'min:10',
                'max:10',
            ],
            'pagina_web' => [
                'string',
                'nullable',
            ],
            'giro' => [
                'string',
                'nullable',
            ],
            'servicios' => [
                'string',
                'nullable',
            ],
        ];
    }
}
