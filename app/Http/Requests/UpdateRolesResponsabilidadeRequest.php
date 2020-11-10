<?php

namespace App\Http\Requests;

use App\Models\RolesResponsabilidade;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateRolesResponsabilidadeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('roles_responsabilidade_edit');
    }

    public function rules()
    {
        return [
            'responsabilidad' => [
                'string',
                'required',
            ],
            'direccionsgsi'   => [
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
            'rol'             => [
                'string',
                'nullable',
            ],
        ];
    }
}
