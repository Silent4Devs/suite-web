<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreRegistromejoraRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('registromejora_create');
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
