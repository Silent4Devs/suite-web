<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreRolesResponsabilidadeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('roles_responsabilidade_create');
    }

    public function rules()
    {
        return [
            'responsabilidad' => [
                'string',
                'required',
            ],
            'direccionsgsi' => [
                'string',
                'required',
            ],
            'comiteseguridad' => [
                'string',
                'nullable',
            ],
            'responsablesgsi' => [
                'string',
                'nullable',
            ],
            'coordinadorsgsi' => [
                'string',
                'nullable',
            ],
            'rol' => [
                'string',
                'nullable',
            ],
        ];
    }
}
