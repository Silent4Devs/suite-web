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
        return [
            'tipo_control_acceso_id' => ['required'],
            'descripcion' => ['required', 'string'],
            'justificacion' => ['required', 'string'],
            'fecha_inicio' => ['required', 'date'],
            'fecha_fin' => ['required', 'date'],
            'responsable_id' => ['required'],
        ];
    }
}
