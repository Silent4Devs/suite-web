<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateOrganizacioneRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('organizacione_edit');
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
