<?php

namespace App\Http\Requests;

use App\Models\Comiteseguridad;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateComiteseguridadRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('comiteseguridad_edit');
    }

    public function rules()
    {
        return [
            'nombrerol'  => [
                'string',
                'required',
            ],
            'fechavigor' => [
                'date',
                'nullable',
            ],
        ];
    }
}
