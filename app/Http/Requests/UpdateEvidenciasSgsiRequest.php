<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEvidenciasSgsiRequest extends FormRequest
{
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
                // 'date_format:' . config('panel.date_format'),
                'date',
                'required',
            ],
        ];
    }
}
