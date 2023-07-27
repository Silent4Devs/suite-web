<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyConcientizacionSgiRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('concientizacion_sgi_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids' => 'required|array',
            'ids.*' => 'exists:concientizacion_sgis,id',
        ];
    }
}
