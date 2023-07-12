<?php

namespace App\Http\Controllers\Admin;

use App\Functions\GeneratePdf;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPlanAuditoriumRequest;
use App\Http\Requests\StorePlanAuditoriumRequest;
use App\Http\Requests\UpdatePlanAuditoriumRequest;
use App\Models\AuditoriaAnual;
use App\Models\PlanAuditorium;
use App\Models\Team;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PlanAuditoriaController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('plan_auditorium_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PlanAuditorium::with(['fecha', 'auditados', 'team'])->select(sprintf('%s.*', (new PlanAuditorium)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'plan_auditorium_show';
                $editGate = 'plan_auditorium_edit';
                $deleteGate = 'plan_auditorium_delete';
                $crudRoutePart = 'plan-auditoria';

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
            $table->addColumn('fecha_fechainicio', function ($row) {
                return $row->fecha ? $row->fecha->fechainicio : '';
            });

            $table->editColumn('fecha.tipo', function ($row) {
                return $row->fecha ? (is_string($row->fecha) ? $row->fecha : $row->fecha->tipo) : '';
            });
            $table->editColumn('fecha.observaciones', function ($row) {
                return $row->fecha ? (is_string($row->fecha) ? $row->fecha : $row->fecha->observaciones) : '';
            });
            $table->editColumn('objetivo', function ($row) {
                return $row->objetivo ? $row->objetivo : '';
            });
            $table->editColumn('alcance', function ($row) {
                return $row->alcance ? $row->alcance : '';
            });
            $table->editColumn('criterios', function ($row) {
                return $row->criterios ? $row->criterios : '';
            });
            $table->editColumn('documentoauditar', function ($row) {
                return $row->documentoauditar ? $row->documentoauditar : '';
            });
            $table->editColumn('equipoauditor', function ($row) {
                return $row->equipoauditor ? $row->equipoauditor : '';
            });
            $table->editColumn('auditados', function ($row) {
                $labels = [];

                foreach ($row->auditados as $auditado) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $auditado->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('descripcion', function ($row) {
                return $row->descripcion ? $row->descripcion : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'fecha', 'auditados']);

            return $table->make(true);
        }

        $auditoria_anuals = AuditoriaAnual::getAll();
        $users = User::getAll();
        $teams = Team::get();

        return view('admin.planAuditoria.index', compact('auditoria_anuals', 'users', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('plan_auditorium_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fechas = AuditoriaAnual::all()->pluck('fechainicio', 'id')->prepend(trans('global.pleaseSelect'), '');

        $auditados = User::all()->pluck('name', 'id');

        return view('admin.planAuditoria.create', compact('fechas', 'auditados'));
    }

    public function store(StorePlanAuditoriumRequest $request)
    {
        $planAuditorium = PlanAuditorium::create($request->all());
        $generar = new GeneratePdf();
        $generar->Generate($request['pdf-value'], $planAuditorium);
        $planAuditorium->auditados()->sync($request->input('auditados', []));

        return redirect()->route('admin.plan-auditoria.index');
    }

    public function edit(PlanAuditorium $planAuditorium)
    {
        abort_if(Gate::denies('plan_auditorium_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fechas = AuditoriaAnual::all()->pluck('fechainicio', 'id')->prepend(trans('global.pleaseSelect'), '');

        $auditados = User::all()->pluck('name', 'id');

        $planAuditorium->load('fecha', 'auditados', 'team');

        return view('admin.planAuditoria.edit', compact('fechas', 'auditados', 'planAuditorium'));
    }

    public function update(UpdatePlanAuditoriumRequest $request, PlanAuditorium $planAuditorium)
    {
        $planAuditorium->update($request->all());
        $planAuditorium->auditados()->sync($request->input('auditados', []));

        return redirect()->route('admin.plan-auditoria.index');
    }

    public function show(PlanAuditorium $planAuditorium)
    {
        abort_if(Gate::denies('plan_auditorium_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $planAuditorium->load('fecha', 'auditados', 'team');

        return view('admin.planAuditoria.show', compact('planAuditorium'));
    }

    public function destroy(PlanAuditorium $planAuditorium)
    {
        abort_if(Gate::denies('plan_auditorium_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $planAuditorium->delete();

        return back();
    }

    public function massDestroy(MassDestroyPlanAuditoriumRequest $request)
    {
        PlanAuditorium::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
