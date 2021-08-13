<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\PlanImplementacion;

class PlanImplementacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        PlanImplementacion::create([ // Necesario se carga inicialmente el Diagrama Universal de Gantt
            'tasks' => [],
            'canAdd' => true,
            'canWrite' =>  true,
            'canWriteOnParent' => true,
            'changesReasonWhy' => false,
            'selectedRow' => 0,
            'zoom' => '3d',
            'parent' => 'Plan de Trabajo',
            'slug' => Str::slug('Plan de Trabajo'),
            'norma' => 'ISO 27001',
            'modulo_origen' => 'Implementación',
            'objetivo' => null,
            'elaboro_id' => null,
        ]);
    }
}
