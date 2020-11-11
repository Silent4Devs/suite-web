<?php

namespace App\Http\Requests;

use App\Models\TratamientoRiesgo;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTratamientoRiesgoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('tratamiento_riesgo_edit');
    }

    public function rules()
    {
        return [
            'nivelriesgo'         => [
                'string',
                'nullable',
            ],
            'fechacompromiso'     => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'estatus'             => [
                'string',
                'nullable',
            ],
            'probabilidad'        => [
                'string',
                'nullable',
            ],
            'impacto'             => [
                'string',
                'nullable',
            ],
            'nivelriesgoresidual' => [
                'string',
                'nullable',
            ],
        ];
    }
}
