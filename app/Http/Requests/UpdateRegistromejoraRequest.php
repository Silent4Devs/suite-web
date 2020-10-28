<?php

namespace App\Http\Requests;

use App\Models\Registromejora;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateRegistromejoraRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('registromejora_edit');
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
