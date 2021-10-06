<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreGlosarioRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('glosario_create');
    }

    public function rules()
    {
        return [
            'concepto' => [
                'string',
                'required',
            ],
        ];
    }
}
