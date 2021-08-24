<?php

namespace App\Http\Requests;

use App\Models\Area;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

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
