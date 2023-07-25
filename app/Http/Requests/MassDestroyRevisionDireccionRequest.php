<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyRevisionDireccionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('revision_direccion_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids' => 'required|array',
            'ids.*' => 'exists:revision_direccions,id',
        ];
    }
}
