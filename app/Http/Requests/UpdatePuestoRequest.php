<?php

namespace App\Http\Requests;

use App\Models\Puesto;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePuestoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('puesto_edit');
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
