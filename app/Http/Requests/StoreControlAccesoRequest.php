<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreControlAccesoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('control_acceso_create');
    }

    public function rules()
    {
        return [];
    }
}
