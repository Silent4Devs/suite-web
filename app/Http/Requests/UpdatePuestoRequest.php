<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePuestoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('puesto_edit');
    }

    public function rules()
    {
        return [
            'puesto' => [
                'string',
                'required',
            ],
        ];
    }
}
