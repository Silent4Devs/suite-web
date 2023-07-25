<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRegistromejoraRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('registromejora_edit');
    }

    public function rules()
    {
        return [
            'nombre' => [
                'string',
                'nullable',
            ],
            'clasificacion' => [
                'string',
                'nullable',
            ],
        ];
    }
}
