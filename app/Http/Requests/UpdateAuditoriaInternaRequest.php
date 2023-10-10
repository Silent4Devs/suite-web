<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAuditoriaInternaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('auditoria_interna_edit');
    }

    public function rules()
    {
        return [
            'alcance' => [
                'string',
                'required',
            ],
            'fechaauditoria' => [
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
            'totalobservacion' => [
                'numeric',
                'min:0',
                'max:99',
            ],
            'totalmejora' => [
                'numeric',
                'min:0',
                'max:99',
            ],
        ];
    }
}
