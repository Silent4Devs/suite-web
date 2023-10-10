<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAuditoriaAnualRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('auditoria_anual_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids' => 'required|array',
            'ids.*' => 'exists:auditoria_anuals,id',
        ];
    }
}
