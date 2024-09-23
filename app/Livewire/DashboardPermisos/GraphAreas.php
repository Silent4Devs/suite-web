<?php

namespace App\Livewire\DashboardPermisos;

use App\Models\Area;
use App\Models\SolicitudDayOff;
use App\Models\SolicitudPermisoGoceSueldo;
use App\Models\SolicitudVacaciones;
use Carbon\Carbon;
use Livewire\Component;

class GraphAreas extends Component
{
    public $areaSeleccionada;

    public $mes_año;

    public $areasCollect;

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

        $vacaciones = SolicitudVacaciones::where('fecha_fin', '>=', $inicio_mes)->where('fecha_inicio', '<=', $fin_mes)->get();
        $dayOff = SolicitudDayOff::where('fecha_fin', '>=', $inicio_mes)->where('fecha_inicio', '<=', $fin_mes)->get();
        $permisos = SolicitudPermisoGoceSueldo::where('fecha_fin', '>=', $inicio_mes)->where('fecha_inicio', '<=', $fin_mes)->get();

        $areas = Area::get();

        $this->areasCollect = collect();

        foreach ($areas as $area) {

            $vacacionesArea = $vacaciones->filter(function ($vacacion) use ($area) {
                return $vacacion->empleado->area_id === $area->id;
            });

            $dayOffArea = $dayOff->filter(function ($day) use ($area) {
                return $day->empleado->area_id === $area->id;
            });

            $permisosArea = $permisos->filter(function ($permiso) use ($area) {
                return $permiso->empleado->area_id === $area->id;
            });

            $area->vacaciones = $vacacionesArea->count();
            $area->dayOff = $dayOffArea->count();
            $area->permisos = $permisosArea->count();

            $this->areasCollect->push([
                'area' => $area->area,
                'vacaciones' => $area->vacaciones,
                'dayOff' => $area->dayOff,
                'permisos' => $area->permisos,
            ]);
        }

        $this->dispatch('renderScripts', $this->areasCollect);

        return view('livewire.dashboard-permisos.graph-areas');
    }
}
