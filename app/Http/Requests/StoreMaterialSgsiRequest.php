<?php

namespace App\Http\Requests;

use App\Models\MaterialSgsi;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMaterialSgsiRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('material_sgsi_create');
    }

    public function rules()
    {
        return [
            'objetivo'                    => [
                'string',
                'required',
            ],
            'fechacreacion_actualizacion' => [
                'date_format:' . 'd-m-Y',
                'nullable',
            ],
        ];
    }
}
