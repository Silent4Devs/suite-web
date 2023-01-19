<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateArchivoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('archivo_edit');
    }

    public function rules()
    {
        return [
            'carpeta_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
