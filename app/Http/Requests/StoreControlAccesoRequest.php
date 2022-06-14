<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreControlAccesoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('control_de_accesos_agregar');
    }

    public function rules()
    {
        return [];
    }
}
