<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class StorePuestoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('puesto_create');
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
