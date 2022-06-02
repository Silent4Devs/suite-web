<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class DirectorioEmpleadosController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('directorio_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $empleados = Empleado::select('id', 'name', 'puesto_id', 'genero', 'foto', 'telefono_movil', 'area_id', 'supervisor_id', 'antiguedad', 'mostrar_telefono', 'email')->with('area', 'puestoRelacionado', 'supervisor')->alta()->get();

        return view('admin.directorio.index', compact('empleados'));
    }
}
