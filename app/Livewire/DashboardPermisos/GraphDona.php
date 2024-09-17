<?php

namespace App\Livewire\DashboardPermisos;

use App\Models\Area;
use App\Models\SolicitudDayOff;
use App\Models\SolicitudPermisoGoceSueldo;
use App\Models\SolicitudVacaciones;
use Carbon\Carbon;
use Livewire\Component;

class GraphDona extends Component
{
    public $areaSeleccionada;

    public $mes_año;

    public function mounth($areaSeleccionada)
    {
        $this->areaSeleccionada = $areaSeleccionada;
    }

    public function updatedMesAño($value)
    {
        $this->mes_año = $value;
    }

    public function render()
    {
        if ($this->mes_año) {
            $mes_año = Carbon::parse($this->mes_año);
        } else {
            $mes_año = Carbon::now();
        }

        $inicio_mes = $mes_año->copy()->startOfMonth();  // Primer día del mes
        $fin_mes = $mes_año->copy()->endOfMonth();       // Último día del mes

        $vacaciones = SolicitudVacaciones::where('fecha_inicio', '>=', $inicio_mes)->orWhere('fecha_fin', '<=', $fin_mes)->get();
        $dayOff = SolicitudDayOff::where('fecha_inicio', '>=', $inicio_mes)->orWhere('fecha_fin', '<=', $fin_mes)->get();
        $permisos = SolicitudPermisoGoceSueldo::where('fecha_inicio', '>=', $inicio_mes)->orWhere('fecha_fin', '<=', $fin_mes)->get();

        if ($this->areaSeleccionada == 'all') {

        } else {
            $area = Area::find($this->areaSeleccionada);

            $vacaciones = $vacaciones->filter(function ($vacacion) use ($area) {
                return $vacacion->empleado->area_id === $area->id;
            });

            $dayOff = $dayOff->filter(function ($day) use ($area) {
                return $day->empleado->area_id === $area->id;
            });

            $permisos = $permisos->filter(function ($permiso) use ($area) {
                return $permiso->empleado->area_id === $area->id;
            });
        }

        $vacaciones = $vacaciones->count();
        $dayOff = $dayOff->count();
        $permisos = $permisos->count();

        $this->dispatch('renderScripts');

        return view('livewire.dashboard-permisos.graph-dona', compact('vacaciones', 'dayOff', 'permisos'));
    }
}
