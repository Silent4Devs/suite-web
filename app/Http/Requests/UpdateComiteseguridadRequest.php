<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateComiteseguridadRequest extends FormRequest
{
    public function rules()
    {
        return [
            'nombre_comite' => [
                'string',
                'required',
            ],
        ];
    }
}
