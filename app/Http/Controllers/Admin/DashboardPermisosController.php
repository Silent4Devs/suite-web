<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ObtenerOrganizacion;
use App\Models\Area;


class DashboardPermisosController extends Controller
{
    use ObtenerOrganizacion;

    public function dashboardOrg($id)
    {
        if(($id == 'all') or ($id == 'todos') or ($id == 'todas')){
            $areaSeleccionada = 'all';
            // dd('todos');
        }else{
            $areaSeleccionada = $id;

            $area = Area::find($id);
        }


        $areasToSelect = Area::orderBy('area', 'Asc')->get();

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.dashboardSolicitudesPermisos.dashboardOrg', compact('logo_actual', 'empresa_actual', 'areasToSelect', 'areaSeleccionada'));
    }
}
