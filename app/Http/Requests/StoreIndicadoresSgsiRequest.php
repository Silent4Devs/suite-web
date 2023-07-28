<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreIndicadoresSgsiRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('indicadores_sgsi_create');
    }

    public function rules()
    {
        return [
            'titulo' => [
                'string',
                'nullable',
            ],
            'meta' => [
                'string',
                'nullable',
            ],
            'enero' => [
                'numeric',
                'min:0',
                'max:100',
            ],
            'febrero' => [
                'numeric',
                'min:0',
                'max:100',
            ],
            'marzo' => [
                'numeric',
                'min:0',
                'max:100',
            ],
            'abril' => [
                'numeric',
                'min:0',
                'max:100',
            ],
            'mayo' => [
                'numeric',
                'min:0',
                'max:100',
            ],
            'junio' => [
                'numeric',
                'min:0',
                'max:100',
            ],
            'julio' => [
                'numeric',
                'min:0',
                'max:100',
            ],
            'agosto' => [
                'numeric',
                'min:0',
                'max:100',
            ],
            'septiembre' => [
                'numeric',
                'min:0',
                'max:100',
            ],
            'octubre' => [
                'numeric',
                'min:0',
                'max:100',
            ],
            'noviembre' => [
                'numeric',
                'min:0',
                'max:100',
            ],
            'diciembre' => [
                'numeric',
                'min:0',
                'max:100',
            ],
            'anio' => [
                'string',
                'min:4',
                'max:4',
                'nullable',
            ],
        ];
    }
}
