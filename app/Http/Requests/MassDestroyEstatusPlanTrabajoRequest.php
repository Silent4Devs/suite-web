<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyEstatusPlanTrabajoRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('estatus_plan_trabajo_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids' => 'required|array',
            'ids.*' => 'exists:estatus_plan_trabajos,id',
        ];
    }
}
