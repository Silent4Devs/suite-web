<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyEstadoIncidenteRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('estado_incidente_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids' => 'required|array',
            'ids.*' => 'exists:estado_incidentes,id',
        ];
    }
}
