<?php

namespace App\Http\Requests;

use App\Models\Riesgosoportunidade;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

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
