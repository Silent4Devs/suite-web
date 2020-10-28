<?php

namespace App\Http\Requests;

use App\Models\Recurso;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateRecursoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('recurso_edit');
    }

    public function rules()
    {
        return [
            'participantes.*' => [
                'integer',
            ],
            'participantes'   => [
                'array',
            ],
        ];
    }
}
