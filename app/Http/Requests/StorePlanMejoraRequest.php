<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class StorePlanMejoraRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('plan_mejora_create');
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
