<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEstatusPlanTrabajoRequest;
use App\Http\Requests\StoreEstatusPlanTrabajoRequest;
use App\Http\Requests\UpdateEstatusPlanTrabajoRequest;
use App\Models\EstatusPlanTrabajo;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class EstatusPlanTrabajoController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('estatus_plan_trabajo_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = EstatusPlanTrabajo::with(['team'])->select(sprintf('%s.*', (new EstatusPlanTrabajo)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'estatus_plan_trabajo_show';
                $editGate = 'estatus_plan_trabajo_edit';
                $deleteGate = 'estatus_plan_trabajo_delete';
                $crudRoutePart = 'estatus-plan-trabajos';

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
            $table->editColumn('descripcion', function ($row) {
                return $row->descripcion ? $row->descripcion : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $teams = Team::get();

        return view('admin.estatusPlanTrabajos.index', compact('teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('estatus_plan_trabajo_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.estatusPlanTrabajos.create');
    }

    public function store(StoreEstatusPlanTrabajoRequest $request)
    {
        $estatusPlanTrabajo = EstatusPlanTrabajo::create($request->all());

        return redirect()->route('admin.estatus-plan-trabajos.index');
    }

    public function edit(EstatusPlanTrabajo $estatusPlanTrabajo)
    {
        abort_if(Gate::denies('estatus_plan_trabajo_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $estatusPlanTrabajo->load('team');

        return view('admin.estatusPlanTrabajos.edit', compact('estatusPlanTrabajo'));
    }

    public function update(UpdateEstatusPlanTrabajoRequest $request, EstatusPlanTrabajo $estatusPlanTrabajo)
    {
        $estatusPlanTrabajo->update($request->all());

        return redirect()->route('admin.estatus-plan-trabajos.index');
    }

    public function show(EstatusPlanTrabajo $estatusPlanTrabajo)
    {
        abort_if(Gate::denies('estatus_plan_trabajo_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $estatusPlanTrabajo->load('team');

        return view('admin.estatusPlanTrabajos.show', compact('estatusPlanTrabajo'));
    }

    public function destroy(EstatusPlanTrabajo $estatusPlanTrabajo)
    {
        abort_if(Gate::denies('estatus_plan_trabajo_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $estatusPlanTrabajo->delete();

        return back();
    }

    public function massDestroy(MassDestroyEstatusPlanTrabajoRequest $request)
    {
        EstatusPlanTrabajo::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
