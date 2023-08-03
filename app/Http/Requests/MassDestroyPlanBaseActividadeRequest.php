<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPlanBaseActividadeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('plan_base_actividade_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids' => 'required|array',
            'ids.*' => 'exists:plan_base_actividades,id',
        ];
    }
}
