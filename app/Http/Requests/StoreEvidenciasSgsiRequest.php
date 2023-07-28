<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreEvidenciasSgsiRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('evidencia_asignacion_recursos_sgsi_agregar');
    }

    public function rules()
    {
        return [

            'nombredocumento' => [
                'string',
                'required',
            ],
            'objetivodocumento' => [
                'string',
                'required',
            ],
            'responsable_evidencia_id' => [
                'string',
                'required',
            ],
            'area_id' => [
                'string',
                'required',
            ],
            'fechadocumento' => [
                'date',
                'required',
            ],
        ];
    }
}
