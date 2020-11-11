<?php

namespace App\Http\Requests;

use App\Models\ControlAcceso;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

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
