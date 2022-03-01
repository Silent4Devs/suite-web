<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Empleado;
use App\Models\User;
use Illuminate\Http\Request;

class ActivosInformacionController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.activosInformacion.index');
    }

    public function create()
    {
        $empleados = Empleado::with('area')->get();
        $duenos = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $area = Area::get();

        return view('admin.activosInformacion.create', compact('empleados', 'area', 'duenos'));
    }
}
