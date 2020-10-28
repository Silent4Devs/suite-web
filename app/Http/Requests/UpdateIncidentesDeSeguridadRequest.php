<?php

namespace App\Http\Requests;

use App\Models\IncidentesDeSeguridad;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateIncidentesDeSeguridadRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('incidentes_de_seguridad_edit');
    }

    public function rules()
    {
        return [
            'folio'           => [
                'string',
                'required',
            ],
            'fechaocurrencia' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'activos.*'       => [
                'integer',
            ],
            'activos'         => [
                'array',
            ],
            'clasificacion'   => [
                'string',
                'nullable',
            ],
        ];
    }
}
