<?php

namespace App\Http\Requests;

use App\Models\Activo;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreActivoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('activo_create');
    }

    public function rules()
    {
        return [];
    }
}
