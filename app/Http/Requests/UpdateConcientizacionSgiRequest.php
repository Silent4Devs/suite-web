<?php

namespace App\Http\Requests;

use App\Models\ConcientizacionSgi;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

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
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
