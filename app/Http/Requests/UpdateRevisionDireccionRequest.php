<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRevisionDireccionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('revision_direccion_edit');
    }

    public function rules()
    {
        return [
            'estadorevisionesprevias' => [
                'string',
                'nullable',
            ],
            'cambiosinternosexternos' => [
                'string',
                'nullable',
            ],
            'retroalimentaciondesempeno' => [
                'string',
                'nullable',
            ],
            'retroalimentacionpartesinteresadas' => [
                'string',
                'nullable',
            ],
            'resultadosriesgos' => [
                'string',
                'nullable',
            ],
            'oportunidadesmejoracontinua' => [
                'string',
                'nullable',
            ],
        ];
    }
}
