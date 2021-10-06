<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreArchivoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('archivo_create');
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
