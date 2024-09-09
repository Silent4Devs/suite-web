<?php

namespace App\Livewire\DashboardPermisos;

use Livewire\Component;
use App\Models\Area;
use App\Models\SolicitudVacaciones;
use App\Models\SolicitudDayOff;
use App\Models\SolicitudPermisoGoceSueldo;

class GraphDona extends Component
{
    public $areaSeleccionada;

    function mounth($areaSeleccionada) {
        $this->areaSeleccionada = $areaSeleccionada;
    }

    public function render()
    {
        $vacaciones = SolicitudVacaciones::get();
        $dayOff = SolicitudDayOff::get();
        $permisos = SolicitudPermisoGoceSueldo::get();

        if($this->areaSeleccionada == 'all'){

        }else{
            $area = Area::find($this->areaSeleccionada);

            $vacaciones = $vacaciones->filter(function ($vacacion) use ( $area) {
                return $vacacion->empleado->area_id === $area->id;
            });

            $dayOff->filter(function ($day) use ( $area) {
                return $day->empleado->area_id === $area->id;
            });

            $permisos->filter(function ($permiso) use ( $area) {
                return $permiso->empleado->area_id === $area->id;
            });
        }

        $vacaciones = $vacaciones->count();
        $dayOff = $dayOff->count();
        $permisos = $permisos->count();

        return view('livewire.dashboard-permisos.graph-dona', compact('vacaciones', 'dayOff', 'permisos'));
    }
}
