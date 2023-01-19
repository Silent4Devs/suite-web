<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSedeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('configuracion_sede_edit');
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
