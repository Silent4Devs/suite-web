<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;

class SystemCalendarController extends Controller
{
    public $sources = [
        [
            'model'      => '\App\Models\AuditoriaInterna',
            'date_field' => 'fechaauditoria',
            'field'      => 'alcance',
            'prefix'     => '',
            'suffix'     => '',
            'route'      => 'admin.auditoria-internas.edit',
        ],
        [
            'model'      => '\App\Models\PlanaccionCorrectiva',
            'date_field' => 'fechacompromiso',
            'field'      => 'actividad',
            'prefix'     => '',
            'suffix'     => '',
            'route'      => 'admin.planaccion-correctivas.edit',
        ],
        [
            'model'      => '\App\Models\PlanMejora',
            'date_field' => 'fecha_compromiso',
            'field'      => 'descripcion',
            'prefix'     => '',
            'suffix'     => '',
            'route'      => 'admin.plan-mejoras.edit',
        ],
        [
            'model'      => '\App\Models\PlanBaseActividade',
            'date_field' => 'fecha_inicio',
            'field'      => 'actividad',
            'prefix'     => '',
            'suffix'     => '',
            'route'      => 'admin.plan-base-actividades.edit',
        ],
    ];

    public function index()
    {
        $events = [];

        foreach ($this->sources as $source) {
            foreach ($source['model']::all() as $model) {
                $crudFieldValue = $model->getAttributes()[$source['date_field']];

                if (!$crudFieldValue) {
                    continue;
                }

                $events[] = [
                    'title' => trim($source['prefix'] . " " . $model->{$source['field']}
                        . " " . $source['suffix']),
                    'start' => $crudFieldValue,
                    'url'   => route($source['route'], $model->id),
                ];
            }
        }

        return view('admin.calendar.calendar', compact('events'));
    }
}
