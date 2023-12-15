<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePlanaccionCorrectivaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('planaccion_correctiva_edit');
    }

    public function rules()
    {
        return [
            'actividad' => [
                'string',
                'required',
            ],
            'fechacompromiso' => [
                'date_format:'.config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
