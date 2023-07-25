<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPoliticaSgsiRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('politica_sgsi_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids' => 'required|array',
            'ids.*' => 'exists:politica_sgsis,id',
        ];
    }
}
