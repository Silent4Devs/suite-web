<?php

namespace App\Livewire\DashboardPermisos;

use Livewire\Component;
use App\Models\Area;
use App\Models\SolicitudVacaciones;
use App\Models\SolicitudDayOff;
use App\Models\SolicitudPermisoGoceSueldo;
use Carbon\Carbon;

class GraphDona extends Component
{
    public $areaSeleccionada;
    public $mes_año;

    function mounth($areaSeleccionada) {
        $this->areaSeleccionada = $areaSeleccionada;
    }

    function updatedMesAño($value) {
        $this->mes_año = $value;
    }

    public function render()
    {
        if ($this->mes_año) {
            $mes_año = Carbon::parse($this->mes_año);
        }else{
            $mes_año = Carbon::now();
        }

        $vacaciones = SolicitudVacaciones::where('fecha_inicio', '>=', $mes_año)->where('fecha_fin', '<=', $mes_año)->get();
        $dayOff = SolicitudDayOff::where('fecha_inicio', '>=', $mes_año)->where('fecha_fin', '<=', $mes_año)->get();
        $permisos = SolicitudPermisoGoceSueldo::where('fecha_inicio', '>=', $mes_año)->where('fecha_fin', '<=', $mes_año)->get();

        if($this->areaSeleccionada == 'all'){

        }else{
            $area = Area::find($this->areaSeleccionada);

            $vacaciones = $vacaciones->filter(function ($vacacion) use ( $area) {
                return $vacacion->empleado->area_id === $area->id;
            });

            $dayOff = $dayOff->filter(function ($day) use ( $area) {
                return $day->empleado->area_id === $area->id;
            });

            $permisos = $permisos->filter(function ($permiso) use ( $area) {
                return $permiso->empleado->area_id === $area->id;
            });
        }

        $vacaciones = $vacaciones->count();
        $dayOff = $dayOff->count();
        $permisos = $permisos->count();

        return view('livewire.dashboard-permisos.graph-dona', compact('vacaciones', 'dayOff', 'permisos'));
    }
}
