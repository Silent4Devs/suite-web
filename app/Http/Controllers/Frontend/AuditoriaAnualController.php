<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAuditoriaAnualRequest;
use App\Http\Requests\StoreAuditoriaAnualRequest;
use App\Http\Requests\UpdateAuditoriaAnualRequest;
use App\Models\AuditoriaAnual;
use App\Models\Empleado;
use App\Models\Team;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AuditoriaAnualController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('auditoria_anual_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = AuditoriaAnual::with(['auditorlider', 'team'])->select(sprintf('%s.*', (new AuditoriaAnual)->table))->orderByDesc('id');
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'auditoria_anual_show';
                $editGate = 'auditoria_anual_edit';
                $deleteGate = 'auditoria_anual_delete';
                $crudRoutePart = 'auditoria-anuals';

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

            $table->editColumn('tipo', function ($row) {
                return $row->tipo ? AuditoriaAnual::TIPO_SELECT[$row->tipo] : '';
            });

            $table->editColumn('fechainicio', function ($row) {
                return $row->fechainicio ? $row->fechainicio : '';
            });

            $table->editColumn('fechafin', function ($row) {
                return $row->fechafin ? $row->fechafin : '';
            });
            $table->addColumn('auditorlider_name', function ($row) {
                return $row->auditorlider ? $row->auditorlider->name : '';
            });

            $table->editColumn('observaciones', function ($row) {
                return $row->observaciones ? $row->observaciones : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'auditorlider']);

            return $table->make(true);
        }

        $users = User::getAll();
        $teams = Team::get();

        return view('admin.auditoriaAnuals.index', compact('users', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('auditoria_anual_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $auditorliders = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $empleados = Empleado::getAll();

        return view('admin.auditoriaAnuals.create', compact('auditorliders', 'empleados'));
    }

    public function store(StoreAuditoriaAnualRequest $request)
    {
        $auditoriaAnual = AuditoriaAnual::create($request->all());

        return redirect()->route('admin.auditoria-anuals.index');
    }

    public function edit(AuditoriaAnual $auditoriaAnual)
    {
        abort_if(Gate::denies('auditoria_anual_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $auditorliders = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $auditoriaAnual->load('auditorlider', 'team');

        $empleados = Empleado::getAll();

        return view('admin.auditoriaAnuals.edit', compact('auditorliders', 'auditoriaAnual', 'empleados'));
    }

    public function update(UpdateAuditoriaAnualRequest $request, AuditoriaAnual $auditoriaAnual)
    {
        $auditoriaAnual->update($request->all());

        return redirect()->route('admin.auditoria-anuals.index');
    }

    public function show(AuditoriaAnual $auditoriaAnual)
    {
        abort_if(Gate::denies('auditoria_anual_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $auditoriaAnual->load('auditorlider', 'team', 'fechaPlanAuditoria');

        return view('admin.auditoriaAnuals.show', compact('auditoriaAnual'));
    }

    public function destroy(AuditoriaAnual $auditoriaAnual)
    {
        abort_if(Gate::denies('auditoria_anual_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $auditoriaAnual->delete();

        return back();
    }

    public function massDestroy(MassDestroyAuditoriaAnualRequest $request)
    {
        AuditoriaAnual::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
