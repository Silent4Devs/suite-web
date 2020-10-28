<?php

namespace App\Http\Requests;

use App\Models\ControlAcceso;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

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
