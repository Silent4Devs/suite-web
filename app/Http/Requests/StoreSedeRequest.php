<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreSedeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('configuracion_sede_create');
    }

    public function rules()
    {
        return [
            'sede' => [
                'string',
                'required',
            ],
        ];
    }
}
