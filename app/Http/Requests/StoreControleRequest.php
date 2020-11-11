<?php

namespace App\Http\Requests;

use App\Models\Controle;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreControleRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('controle_create');
    }

    public function rules()
    {
        return [
            'numero'  => [
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
