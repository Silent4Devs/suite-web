<?php

namespace App\Livewire\DashboardPermisos;

use Livewire\Component;
use App\Models\SolicitudPermisoGoceSueldo;
use App\Models\PermisosGoceSueldo;

class GraphTypes extends Component
{
    public $areaSeleccionada;

    function mounth($areaSeleccionada) {
        $this->areaSeleccionada = $areaSeleccionada;
    }

    public function render()
    {
        $permisos = PermisosGoceSueldo::get();
        $permisosSolicitudes = SolicitudPermisoGoceSueldo::get();

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

        return view('livewire.dashboard-permisos.graph-types', compact('permisosCollect'));
    }
}
