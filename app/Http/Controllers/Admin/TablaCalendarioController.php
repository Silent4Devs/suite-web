<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Calendario;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;

class TablaCalendarioController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('eventos_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $query = Calendario::orderByDesc('id')->get();
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'eventos_ver';
                $editGate = 'eventos_editar';
                $deleteGate = 'eventos_eliminar';
                $crudRoutePart = 'tabla-calendario';

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

        return view('admin.tabla-calendario.index');
    }

    public function create(Request $request)
    {
        abort_if(Gate::denies('eventos_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $calendario = new Calendario();

        return view('admin.tabla-calendario.create', compact('calendario'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('eventos_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $fecha = Calendario::create($request->all());

        return redirect(route('admin.tabla-calendario.index'))->with(['success' => 'Registro guardado con exito']);
    }

    public function show($calendario)
    {
        abort_if(Gate::denies('eventos_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $fecha = Calendario::find($calendario);

        return view('admin.tabla-calendario.show', compact('fecha'));
    }

    public function edit(Calendario $calendario)
    {
        abort_if(Gate::denies('eventos_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tabla-calendario.edit', compact('calendario'));
    }

    public function update(Request $request, Calendario $calendario)
    {
        abort_if(Gate::denies('eventos_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $fecha = $calendario->update($request->all());

        return redirect(route('admin.tabla-calendario.index'))->with(['success' => 'Registro Actualizado']);
    }

    public function destroy(Calendario $calendario)
    {
        abort_if(Gate::denies('eventos_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $calendario->delete();

        return redirect(route('admin.tabla-calendario.index'))->with(['success' => 'Registro Eliminado']);
    }
}
