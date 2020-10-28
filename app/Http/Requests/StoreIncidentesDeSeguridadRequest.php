<?php

namespace App\Http\Requests;

use App\Models\IncidentesDeSeguridad;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreIncidentesDeSeguridadRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('incidentes_de_seguridad_create');
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
