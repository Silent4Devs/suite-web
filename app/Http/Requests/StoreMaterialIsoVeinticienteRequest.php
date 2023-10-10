<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreMaterialIsoVeinticienteRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('material_iso_veinticiente_create');
    }

    public function rules()
    {
        return [
            'objetivo' => [
                'string',
                'required',
            ],
            'fechacreacion_actualizacion' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
