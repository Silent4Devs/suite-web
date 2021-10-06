<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAreaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('configuracion_area_edit');
    }

    public function rules()
    {
        return [
            'area' => [
                'string',
                'nullable',
            ],
        ];
    }
}
