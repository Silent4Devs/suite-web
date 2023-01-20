<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrganizacioneRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('organizacione_create');
    }

    public function rules()
    {
        return [
            'organizacion' => [
                'string',
                'required',
            ],
        ];
    }
}
