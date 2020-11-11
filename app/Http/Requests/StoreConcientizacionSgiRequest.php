<?php

namespace App\Http\Requests;

use App\Models\ConcientizacionSgi;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreConcientizacionSgiRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('concientizacion_sgi_create');
    }

    public function rules()
    {
        return [
            'objetivocomunicado' => [
                'string',
                'required',
            ],
            'fecha_publicacion'  => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
