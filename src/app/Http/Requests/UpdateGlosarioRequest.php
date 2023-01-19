<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateGlosarioRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('glosario_edit');
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
