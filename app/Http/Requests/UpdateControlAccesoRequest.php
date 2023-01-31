<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateControlAccesoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('control_de_accesos_editar');
    }

    public function rules()
    {
        return [
            'descripcion' => ['required', 'string'],
        ];
    }
}
