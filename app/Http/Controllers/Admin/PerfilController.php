<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Empleado;
use App\Models\PerfilEmpleado;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PerfilController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = PerfilEmpleado::with(['empleados'])->orderBy('id')->get();
            $table = DataTables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'user_show';
                $editGate = 'user_edit';
                $deleteGate = 'user_delete';
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
        $empleados = Empleado::get();

        return view('admin.perfiles.create', compact('empleados'));
    }

    public function store(Request $request)
    {

        $perfil = PerfilEmpleado::create($request->all());

        return redirect()->route('admin.perfiles.index')->with('success', 'Guardado con éxito');
    }

    public function edit($perfil)
    {

        $perfil = PerfilEmpleado::find($perfil);

        return view('admin.perfiles.edit', compact('perfil'));
    }

    public function update(Request $request,$perfil)
    {
        $perfil = PerfilEmpleado::find($perfil);
        $perfil->update($request->all());
        return redirect()->route('admin.perfiles.index')->with('success', 'Editado con éxito');
    }

    public function destroy($perfil)
    {
        $perfil = PerfilEmpleado::find($perfil);
        // dd($perfil);
        $perfil->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');
    }
}
