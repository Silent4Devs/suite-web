<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreCompetenciumRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('competencium_create');
    }

    public function rules()
    {
        return [
            'nombrecolaborador_id' => [
                'required',
                'integer',
            ],
            'perfilpuesto' => [
                'string',
                'nullable',
            ],
        ];
    }
}
