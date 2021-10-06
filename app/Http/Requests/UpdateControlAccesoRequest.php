<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateControlAccesoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('control_acceso_edit');
    }

    public function rules()
    {
        return [];
    }
}
