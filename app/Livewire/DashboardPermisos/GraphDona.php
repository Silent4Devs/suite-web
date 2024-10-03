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

    public $vacaciones;

    public $dayOff;

    public $permisos;

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

        $inicio_mes = $mes_año->copy()->startOfMonth();
        $fin_mes = $mes_año->copy()->endOfMonth();

        $vacaciones = SolicitudVacaciones::where('fecha_fin', '>=', $inicio_mes)->where('fecha_inicio', '<=', $fin_mes)->get();
        $dayOff = SolicitudDayOff::where('fecha_fin', '>=', $inicio_mes)->where('fecha_inicio', '<=', $fin_mes)->get();
        $permisos = SolicitudPermisoGoceSueldo::where('fecha_fin', '>=', $inicio_mes)->where('fecha_inicio', '<=', $fin_mes)->get();

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

        $this->vacaciones = $vacaciones->count();
        $this->dayOff = $dayOff->count();
        $this->permisos = $permisos->count();

        $this->dispatch('renderScriptsDona', $this->vacaciones, $this->dayOff, $this->permisos);

        return view('livewire.dashboard-permisos.graph-dona');
    }
}
