<?php

namespace App\Livewire\DashboardPermisos;

use App\Models\Area;
use App\Models\PermisosGoceSueldo;
use App\Models\SolicitudPermisoGoceSueldo;
use Carbon\Carbon;
use Livewire\Component;

class GraphTypes extends Component
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

        $permisosTipos = PermisosGoceSueldo::get();
        $permisosSolicitudes = SolicitudPermisoGoceSueldo::where('fecha_fin', '>=', $inicio_mes)->where('fecha_inicio', '<=', $fin_mes)->get();

        if ($this->areaSeleccionada == 'all') {

        } else {
            $area = Area::find($this->areaSeleccionada);

            $permisosSolicitudes = $permisosSolicitudes->filter(function ($permiso) use ($area) {
                return $permiso->empleado->area_id === $area->id;
            });
        }

        $permisosCollect = collect();
        foreach ($permisosTipos as $permiso) {

            $permisosSolicitudesFilter = $permisosSolicitudes->filter(function ($permisoSolicitud) use ($permiso) {
                return $permisoSolicitud->permiso_id === $permiso->id;
            });

            $permisosCollect->push([
                'nombre' => $permiso->nombre,
                'noPermisos' => $permisosSolicitudesFilter->count(),
            ]);
        }

        $this->dispatch('renderScriptsTypes');
        $this->dispatch('renderScriptsTypes', $permisosCollect);

        return view('livewire.dashboard-permisos.graph-types', compact('permisosCollect'));
    }
}
