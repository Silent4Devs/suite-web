<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreObjetivosseguridadRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('objetivosseguridad_create');
    }

    public function rules()
    {
        return [
            'objetivoseguridad' => [
                'string',
                'required',
            ],
            'indicador' => [
                'string',
                'nullable',
            ],
            'anio' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
