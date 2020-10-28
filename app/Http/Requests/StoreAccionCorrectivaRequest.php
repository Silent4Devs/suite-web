<?php

namespace App\Http\Requests;

use App\Models\AccionCorrectiva;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAccionCorrectivaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('accion_correctiva_create');
    }

    public function rules()
    {
        return [
            'fecharegistro'      => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'fecha_compromiso'   => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'fecha_verificacion' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
