<?php

namespace App\Http\Requests;

use App\Models\EstadoDocumento;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEstadoDocumentoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('estado_documento_edit');
    }

    public function rules()
    {
        return [
            'estado' => [
                'string',
                'nullable',
            ],
        ];
    }
}
