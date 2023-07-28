<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMinutasaltadireccionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('minutasaltadireccion_edit');
    }

    public function rules()
    {
        return [
            'arearesponsable' => [
                'string',
                'nullable',
            ],
            'fechareunion' => [
                'date_format:'.config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
