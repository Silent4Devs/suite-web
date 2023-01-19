<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateActivoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('configuracion_activo_edit');
    }

    public function rules()
    {
        return [];
    }
}
