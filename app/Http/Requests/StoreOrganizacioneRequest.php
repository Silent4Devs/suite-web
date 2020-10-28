<?php

namespace App\Http\Requests;

use App\Models\Organizacione;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

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
