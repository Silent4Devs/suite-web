<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreComiteseguridadRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('comiteseguridad_create');
    }

    public function rules()
    {
        return [
            'nombrerol' => [
                'string',
                'required',
            ],
            'fechavigor' => [
                'date',
                'nullable',
            ],
        ];
    }
}
