<?php

namespace App\Http\Requests;

use App\Models\Glosario;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreGlosarioRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('glosario_create');
    }

    public function rules()
    {
        return [
            'concepto' => [
                'string',
                'required',
            ],
        ];
    }
}
