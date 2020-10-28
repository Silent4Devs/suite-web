<?php

namespace App\Http\Requests;

use App\Models\AuditoriaInterna;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAuditoriaInternaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('auditoria_interna_create');
    }

    public function rules()
    {
        return [
            'alcance'                 => [
                'string',
                'required',
            ],
            'fechaauditoria'          => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'totalnoconformidadmenor' => [
                'numeric',
                'min:0',
                'max:99',
            ],
            'totalnoconformidadmayor' => [
                'numeric',
                'min:0',
                'max:99',
            ],
            'totalobservacion'        => [
                'numeric',
                'min:0',
                'max:99',
            ],
            'totalmejora'             => [
                'numeric',
                'min:0',
                'max:99',
            ],
        ];
    }
}
