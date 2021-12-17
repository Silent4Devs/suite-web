<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Empleado;
use Illuminate\Http\Request;

class DirectorioEmpleadosController extends Controller
{
    public function index(Request $request)
    {
        $empleados = Empleado::select('id', 'name', 'puesto_id', 'genero', 'foto', 'telefono_movil', 'area_id', 'supervisor_id', 'antiguedad')->with('area', 'puestoRelacionado', 'supervisor')->get();

        return view('admin.directorio.index', compact('empleados'));
    }
}
