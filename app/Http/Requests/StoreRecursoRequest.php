<?php

namespace App\Http\Requests;

use App\Models\Recurso;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreRecursoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('recurso_create');
    }

    public function rules()
    {
        return [
            'fecha_curso'     => [
                // 'date_format:' . config('panel.date_format'),
                'date',
                'nullable',
            ],
            'participantes.*' => [
                'integer',
            ],
            'participantes'   => [
                'array',
            ],
            'instructor'      => [
                'string',
                'nullable',
            ],
        ];
    }
}
