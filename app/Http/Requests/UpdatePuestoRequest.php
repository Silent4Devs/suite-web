<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePuestoRequest extends FormRequest
{
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
