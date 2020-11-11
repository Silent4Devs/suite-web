<?php

namespace App\Http\Requests;

use App\Models\Competencium;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCompetenciumRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('competencium_edit');
    }

    public function rules()
    {
        return [
            'nombrecolaborador_id' => [
                'required',
                'integer',
            ],
            'perfilpuesto'         => [
                'string',
                'nullable',
            ],
        ];
    }
}
