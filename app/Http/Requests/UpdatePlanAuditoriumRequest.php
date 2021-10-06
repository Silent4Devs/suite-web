<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePlanAuditoriumRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('plan_auditorium_edit');
    }

    public function rules()
    {
        return [
            'equipoauditor' => [
                'string',
                'nullable',
            ],
            'auditados.*'   => [
                'integer',
            ],
            'auditados'     => [
                'array',
            ],
        ];
    }
}
