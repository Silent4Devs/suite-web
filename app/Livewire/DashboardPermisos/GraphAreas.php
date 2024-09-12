<?php

namespace App\Livewire\DashboardPermisos;

use Livewire\Component;
use App\Models\Area;
use App\Models\SolicitudVacaciones;
use App\Models\SolicitudDayOff;
use App\Models\SolicitudPermisoGoceSueldo;
use Carbon\Carbon;

class GraphAreas extends Component
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

        $areas = Area::get();

        $areasCollect = collect();

        foreach ($areas as $area) {

            $vacacionesArea = $vacaciones->filter(function ($vacacion) use ( $area) {
                return $vacacion->empleado->area_id === $area->id;
            });

            $dayOffArea = $dayOff->filter(function ($day) use ( $area) {
                return $day->empleado->area_id === $area->id;
            });

            $permisosArea = $permisos->filter(function ($permiso) use ( $area) {
                return $permiso->empleado->area_id === $area->id;
            });

            $area->vacaciones = $vacacionesArea->count();
            $area->dayOff = $dayOffArea->count();
            $area->permisos = $permisosArea->count();

            $areasCollect->push([
                'area' => $area->area,
                'vacaciones' => $area->vacaciones,
                'dayOff' => $area->dayOff,
                'permisos' => $area->permisos,
            ]);
        }

        $this->dispatch('renderScripts');

        return view('livewire.dashboard-permisos.graph-areas', compact('areasCollect'));
    }
}
