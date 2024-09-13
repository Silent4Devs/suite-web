<?php

namespace App\Livewire\DashboardPermisos;

use Livewire\Component;
use App\Models\SolicitudPermisoGoceSueldo;
use App\Models\PermisosGoceSueldo;
use Carbon\Carbon;

class GraphTypes extends Component
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

        $inicio_mes = $mes_año->copy()->startOfMonth();  // Primer día del mes
        $fin_mes = $mes_año->copy()->endOfMonth();       // Último día del mes

        $permisos = PermisosGoceSueldo::get();
        $permisosSolicitudes = SolicitudPermisoGoceSueldo::where('fecha_inicio', '>=', $inicio_mes)->orWhere('fecha_fin', '<=', $fin_mes)->get();

        $permisosCollect = collect();
        foreach ($permisos as $permiso) {

            $permisosSolicitudesFilter = $permisosSolicitudes->filter(function($permisoSolicitud) use ($permiso) {
                return $permisoSolicitud->permiso_id === $permiso->id;
            });

            $permisosCollect->push([
                'nombre' => $permiso->nombre,
                'noPermisos' => $permisosSolicitudesFilter->count(),
            ]);
        }

        $this->dispatch('renderScripts');

        return view('livewire.dashboard-permisos.graph-types', compact('permisosCollect'));
    }
}
