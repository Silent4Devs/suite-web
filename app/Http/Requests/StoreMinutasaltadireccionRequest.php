<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreMinutasaltadireccionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('minutasaltadireccion_create');
    }

    public function rules()
    {
        return [
            'arearesponsable' => [
                'string',
                'nullable',
            ],
            'fechareunion' => [
                'date',
                'nullable',
            ],
        ];
    }
}
