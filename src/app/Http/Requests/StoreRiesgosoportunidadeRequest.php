<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreRiesgosoportunidadeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('riesgosoportunidade_create');
    }

    public function rules()
    {
        return [];
    }
}
