<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyIncidentesDeSeguridadRequest;
use App\Http\Requests\StoreIncidentesDeSeguridadRequest;
use App\Http\Requests\UpdateIncidentesDeSeguridadRequest;
use App\Models\Activo;
use App\Models\EstadoIncidente;
use App\Models\IncidentesDeSeguridad;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class IncidentesDeSeguridadController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('incidentes_de_seguridad_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = IncidentesDeSeguridad::with(['activos', 'estado', 'team'])->select(sprintf('%s.*', (new IncidentesDeSeguridad)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'incidentes_de_seguridad_show';
                $editGate = 'incidentes_de_seguridad_edit';
                $deleteGate = 'incidentes_de_seguridad_delete';
                $crudRoutePart = 'incidentes-de-seguridads';

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
            $table->editColumn('folio', function ($row) {
                return $row->folio ? $row->folio : '';
            });
            $table->editColumn('resumen', function ($row) {
                return $row->resumen ? $row->resumen : '';
            });
            $table->editColumn('prioridad', function ($row) {
                return $row->prioridad ? IncidentesDeSeguridad::PRIORIDAD_SELECT[$row->prioridad] : '';
            });

            $table->editColumn('activo', function ($row) {
                $labels = [];

                foreach ($row->activos as $activo) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $activo->descripcion);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('clasificacion', function ($row) {
                return $row->clasificacion ? $row->clasificacion : '';
            });
            $table->addColumn('estado_estado', function ($row) {
                return $row->estado ? $row->estado->estado : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'activo', 'estado']);

            return $table->make(true);
        }

        $activos = Activo::getAll();
        $estado_incidentes = EstadoIncidente::get();
        $teams = Team::get();

        return view('admin.incidentesDeSeguridads.index', compact('activos', 'estado_incidentes', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('incidentes_de_seguridad_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $activos = Activo::all()->pluck('descripcion', 'id');

        $estados = EstadoIncidente::all()->pluck('estado', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.incidentesDeSeguridads.create', compact('activos', 'estados'));
    }

    public function store(StoreIncidentesDeSeguridadRequest $request)
    {
        $incidentesDeSeguridad = IncidentesDeSeguridad::create($request->all());
        $incidentesDeSeguridad->activos()->sync($request->input('activos', []));

        return redirect()->route('admin.incidentes-de-seguridads.index');
    }

    public function edit(IncidentesDeSeguridad $incidentesDeSeguridad)
    {
        abort_if(Gate::denies('incidentes_de_seguridad_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $activos = Activo::all()->pluck('descripcion', 'id');

        $estados = EstadoIncidente::all()->pluck('estado', 'id')->prepend(trans('global.pleaseSelect'), '');

        $incidentesDeSeguridad->load('activos', 'estado', 'team');

        return view('admin.incidentesDeSeguridads.edit', compact('activos', 'estados', 'incidentesDeSeguridad'));
    }

    public function update(UpdateIncidentesDeSeguridadRequest $request, IncidentesDeSeguridad $incidentesDeSeguridad)
    {
        $incidentesDeSeguridad->update($request->all());
        $incidentesDeSeguridad->activos()->sync($request->input('activos', []));

        return redirect()->route('admin.incidentes-de-seguridads.index');
    }

    public function show(IncidentesDeSeguridad $incidentesDeSeguridad)
    {
        abort_if(Gate::denies('incidentes_de_seguridad_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $incidentesDeSeguridad->load('activos', 'estado', 'team');

        return view('admin.incidentesDeSeguridads.show', compact('incidentesDeSeguridad'));
    }

    public function destroy(IncidentesDeSeguridad $incidentesDeSeguridad)
    {
        abort_if(Gate::denies('incidentes_de_seguridad_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $incidentesDeSeguridad->delete();

        return back();
    }

    public function massDestroy(MassDestroyIncidentesDeSeguridadRequest $request)
    {
        IncidentesDeSeguridad::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
