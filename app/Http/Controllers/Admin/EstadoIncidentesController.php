<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEstadoIncidenteRequest;
use App\Http\Requests\StoreEstadoIncidenteRequest;
use App\Http\Requests\UpdateEstadoIncidenteRequest;
use App\Models\EstadoIncidente;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class EstadoIncidentesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('estado_incidente_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = EstadoIncidente::with(['team'])->select(sprintf('%s.*', (new EstadoIncidente)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'estado_incidente_show';
                $editGate = 'estado_incidente_edit';
                $deleteGate = 'estado_incidente_delete';
                $crudRoutePart = 'estado-incidentes';

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
            $table->editColumn('estado', function ($row) {
                return $row->estado ? $row->estado : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $teams = Team::get();

        return view('admin.estadoIncidentes.index', compact('teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('estado_incidente_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.estadoIncidentes.create');
    }

    public function store(StoreEstadoIncidenteRequest $request)
    {
        $estadoIncidente = EstadoIncidente::create($request->all());

        return redirect()->route('admin.estado-incidentes.index');
    }

    public function edit(EstadoIncidente $estadoIncidente)
    {
        abort_if(Gate::denies('estado_incidente_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $estadoIncidente->load('team');

        return view('admin.estadoIncidentes.edit', compact('estadoIncidente'));
    }

    public function update(UpdateEstadoIncidenteRequest $request, EstadoIncidente $estadoIncidente)
    {
        $estadoIncidente->update($request->all());

        return redirect()->route('admin.estado-incidentes.index');
    }

    public function show(EstadoIncidente $estadoIncidente)
    {
        abort_if(Gate::denies('estado_incidente_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $estadoIncidente->load('team');

        return view('admin.estadoIncidentes.show', compact('estadoIncidente'));
    }

    public function destroy(EstadoIncidente $estadoIncidente)
    {
        abort_if(Gate::denies('estado_incidente_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $estadoIncidente->delete();

        return back();
    }

    public function massDestroy(MassDestroyEstadoIncidenteRequest $request)
    {
        EstadoIncidente::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
