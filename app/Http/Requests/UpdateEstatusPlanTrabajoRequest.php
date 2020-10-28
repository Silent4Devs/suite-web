<?php

namespace App\Http\Requests;

use App\Models\EstatusPlanTrabajo;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEstatusPlanTrabajoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('estatus_plan_trabajo_edit');
    }

    public function rules()
    {
        return [
            'estado' => [
                'string',
                'nullable',
            ],
        ];
    }
}
