<?php

namespace App\Http\Requests;

use App\Models\Registromejora;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreRegistromejoraRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('registromejora_create');
    }

    public function rules()
    {
        return [
            'nombre'        => [
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
