<?php

namespace App\Http\Requests;

use App\Models\Tipoactivo;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTipoactivoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('tipoactivo_edit');
    }

    public function rules()
    {
        return [
            'tipo'    => [
                'string',
                'required',
            ],
            'subtipo' => [
                'string',
                'required',
            ],
        ];
    }
}
