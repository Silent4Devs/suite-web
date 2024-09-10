<?php

namespace App\Livewire\DashboardPermisos;

use Livewire\Component;
use App\Models\Area;
use App\Models\SolicitudVacaciones;
use App\Models\SolicitudDayOff;
use App\Models\SolicitudPermisoGoceSueldo;

class GraphAreas extends Component
{

    public $areaSeleccionada;



    public function render()
    {
        $vacaciones = SolicitudVacaciones::get();
        $dayOff = SolicitudDayOff::get();
        $permisos = SolicitudPermisoGoceSueldo::get();

        $areas = Area::get();

        $areasCollect = collect();

        foreach ($areas as $area) {

            $vacaciones = $vacaciones->filter(function ($vacacion) use ( $area) {
                return $vacacion->empleado->area_id === $area->id;
            });

            $dayOff->filter(function ($day) use ( $area) {
                return $day->empleado->area_id === $area->id;
            });

            $permisos->filter(function ($permiso) use ( $area) {
                return $permiso->empleado->area_id === $area->id;
            });

            $area->vacaciones = $vacaciones->count();
            $area->dayOff = $dayOff->count();
            $area->permisos = $permisos->count();

            $areasCollect->push([
                'area' => $area->area,
                'vacaciones' => $area->vacaciones,
                'dayOff' => $area->dayOff,
                'permisos' => $area->permisos,
            ]);
        }

        return view('livewire.dashboard-permisos.graph-areas', compact('areasCollect'));
    }
}
