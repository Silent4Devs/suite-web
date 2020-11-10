<?php

namespace App\Http\Requests;

use App\Models\Organizacion;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreOrganizacionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('organizacion_create');
    }

    public function rules()
    {
        return [
            'empresa'    => [
                'string',
                'required',
            ],
            'direccion'  => [
                'required',
            ],
            'telefono'   => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'pagina_web' => [
                'string',
                'nullable',
            ],
            'giro'       => [
                'string',
                'nullable',
            ],
            'servicios'  => [
                'string',
                'nullable',
            ],
        ];
    }
}
