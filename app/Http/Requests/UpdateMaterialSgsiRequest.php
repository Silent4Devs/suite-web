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
            'nombre' => [
                'string',
                'required',
            ],
            'objetivo' => [
                'string',
                'required',
            ],
            'fechacreacion_actualizacion' => [
                'date',
                'required',
            ],
            'material_id',
            'personalobjetivo' => [
                'required',
            ],
            'arearesponsable_id' => [
                'required',
            ],
            'tipoimparticion' => [
                'required',
            ],
        ];
    }
}
