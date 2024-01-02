<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Empleado;
use App\Models\PerfilEmpleado;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;

class PerfilController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('niveles_jerarquicos_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $query = PerfilEmpleado::get();

            $table = DataTables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'niveles_jerarquicos_agregar';
                $editGate = 'niveles_jerarquicos_editar';
                $deleteGate = 'niveles_jerarquicos_eliminar';
                $crudRoutePart = 'perfiles';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('perfil', function ($row) {
                return $row->nombre ? $row->nombre : '';
            });
            $table->editColumn('descripcion', function ($row) {
                return $row->descripcion ? $row->descripcion : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'activo_id', 'controles']);

            return $table->make(true);
        }

        return view('admin.perfiles.index');
    }

    public function create()
    {
        abort_if(Gate::denies('niveles_jerarquicos_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $empleados = Empleado::getAll();

        return view('admin.perfiles.create', compact('empleados'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('niveles_jerarquicos_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        PerfilEmpleado::create($request->all());

        return redirect()->route('admin.perfiles.index')->with('success', 'Guardado con éxito');
    }

    public function edit($perfil)
    {
        abort_if(Gate::denies('niveles_jerarquicos_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $perfil = PerfilEmpleado::find($perfil);

        return view('admin.perfiles.edit', compact('perfil'));
    }

    public function update(Request $request, $perfil)
    {
        abort_if(Gate::denies('niveles_jerarquicos_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $perfil = PerfilEmpleado::find($perfil);
        $perfil->update($request->all());

        return redirect()->route('admin.perfiles.index')->with('success', 'Editado con éxito');
    }

    public function show($perfil)
    {
        abort_if(Gate::denies('niveles_jerarquicos_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $perfil = PerfilEmpleado::find($perfil);

        return view('admin.perfiles.show', compact('perfil'));
    }

    public function destroy($perfil)
    {
        abort_if(Gate::denies('niveles_jerarquicos_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $perfil = PerfilEmpleado::find($perfil);
        // dd($perfil);
        $perfil->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');
    }
}