<?php

namespace Database\Seeders;

use App\Models\ListaInformativa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ListaInformativaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $modulos = [
            [
                'modulo' => 'Solicitudes',
                'submodulo' => 'Solicitar Vacaciones',
                'modelo' => 'SolicitudVacaciones',
            ],
            [
                'modulo' => 'Solicitudes',
                'submodulo' => 'Solicitar Day-Off',
                'modelo' => 'SolicitudDayOff',
            ],
            [
                'modulo' => 'Timesheet',
                'submodulo' => 'Proyectos',
                'modelo' => 'TimesheetProyecto',
            ],
        ];

        ListaInformativa::insert($modulos);
    }
}
