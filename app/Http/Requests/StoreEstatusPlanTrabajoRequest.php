<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreEstatusPlanTrabajoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('estatus_plan_trabajo_create');
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
