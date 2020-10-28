<?php

namespace App\Http\Requests;

use App\Models\Puesto;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

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
