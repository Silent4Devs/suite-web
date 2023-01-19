<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreActivoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('configuracion_activo_create');
    }

    public function rules()
    {
        return [];
    }
}
