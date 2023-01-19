<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRiesgosoportunidadeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('riesgosoportunidade_edit');
    }

    public function rules()
    {
        return [];
    }
}
