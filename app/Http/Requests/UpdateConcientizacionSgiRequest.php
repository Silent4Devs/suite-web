<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateConcientizacionSgiRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('concientizacion_sgi_edit');
    }

    public function rules()
    {
        return [
            'objetivocomunicado' => [
                'string',
                'required',
            ],
            'fecha_publicacion'  => [
                'date',
                'nullable',
            ],
        ];
    }
}
