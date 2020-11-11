<?php

namespace App\Http\Requests;

use App\Models\PlanaccionCorrectiva;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePlanaccionCorrectivaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('planaccion_correctiva_edit');
    }

    public function rules()
    {
        return [
            'actividad'       => [
                'string',
                'required',
            ],
            'fechacompromiso' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
