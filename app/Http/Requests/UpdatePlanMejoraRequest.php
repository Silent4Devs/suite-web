<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePlanMejoraRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('plan_mejora_edit');
    }

    public function rules()
    {
        return [
            'fecha_compromiso' => [
                'date_format:'.config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
