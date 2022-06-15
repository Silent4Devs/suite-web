<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateComiteseguridadRequest extends FormRequest
{
    public function rules()
    {
        return [
            'nombrerol'  => [
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
