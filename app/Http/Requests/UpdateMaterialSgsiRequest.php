<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMaterialSgsiRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('material_sgsi_editar');
    }

    public function rules()
    {
        return [
            'objetivo'                    => [
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
