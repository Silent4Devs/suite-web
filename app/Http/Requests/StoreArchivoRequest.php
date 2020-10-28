<?php

namespace App\Http\Requests;

use App\Models\Archivo;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

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
