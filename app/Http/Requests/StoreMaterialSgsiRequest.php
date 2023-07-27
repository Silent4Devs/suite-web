<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreMaterialSgsiRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('material_sgsi_agregar');
    }

    public function rules()
    {
        return [
            'objetivo' => [
                'string',
                'required',
            ],
            'fechacreacion_actualizacion' => [
                'date',
                'nullable',
            ],
        ];
    }
}
