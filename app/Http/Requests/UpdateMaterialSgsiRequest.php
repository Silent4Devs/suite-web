<?php

namespace App\Http\Requests;

use App\Models\MaterialSgsi;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMaterialSgsiRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('material_sgsi_edit');
    }

    public function rules()
    {
        return [
            'objetivo'                    => [
                'string',
                'required',
            ],
            'fechacreacion_actualizacion' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
