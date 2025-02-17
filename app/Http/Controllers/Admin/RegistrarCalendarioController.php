<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Calendario;
use DataTables;
use Illuminate\Http\Request;

class RegistrarCalendarioController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Calendario::orderByDesc('id')->get();
            $table = DataTables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'user_show';
                $editGate = 'user_edit';
                $deleteGate = 'user_delete';
                $crudRoutePart = 'registrarGlosario';

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
            $table->editColumn('nombre', function ($row) {
                return $row->nombre ? $row->nombre : '';
            });
            $table->editColumn('fecha', function ($row) {
                return $row->fecha ? $row->fecha : '';
            });
            $table->editColumn('categoria', function ($row) {
                return $row->categoria ? $row->categoria : '';
            });
            $table->editColumn('descripcion', function ($row) {
                return $row->descripcion ? $row->descripcion : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.registrarGlosario.index');
    }

    public function create(Request $request)
    {
        $calendario = new Calendario;

        return view('admin.registrarGlosario.create', compact('calendario'));
    }

    public function store(Request $request)
    {
        $fecha = Calendario::create($request->all());

        return redirect(route('admin.registrarGlosario.index'))->with(['success' => 'Registro guardado con exito']);
    }

    public function show($id_calendario)
    {
        // abort_if(Gate::denies('enlaces_ejecutar_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $calendario = Calendario::where('id', $id_calendario)->first();

        return view('admin.registrarGlosario.show', compact('calendario'));
    }

    public function edit($id_calendario)
    {
        $calendario = Calendario::where('id', $id_calendario)->first();

        return view('admin.registrarGlosario.edit', compact('calendario'));
    }

    public function update(Request $request, $id_calendario)
    {
        $calendario = Calendario::where('id', $id_calendario)->first();
        $fecha = $calendario->update($request->all());

        return redirect(route('admin.registrarGlosario.index'))->with(['success' => 'Registro Actualizado']);
    }

    public function destroy($id_calendario)
    {
        $calendario = Calendario::where('id', $id_calendario)->first();
        $calendario->delete();

        return redirect(route('admin.registrarGlosario.index'))->with(['success' => 'Registro Eliminado']);
    }
}
