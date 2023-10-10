<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreControleRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('controle_create');
    }

    public function rules()
    {
        return [
            'numero' => [
                'string',
                'nullable',
            ],
            'control' => [
                'string',
                'nullable',
            ],
        ];
    }
}
