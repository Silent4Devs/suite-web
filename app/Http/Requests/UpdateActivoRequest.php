<?php

namespace App\Http\Requests;

use App\Models\Activo;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

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
