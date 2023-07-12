<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPlanMejoraRequest;
use App\Http\Requests\StorePlanMejoraRequest;
use App\Http\Requests\UpdatePlanMejoraRequest;
use App\Models\PlanMejora;
use App\Models\Registromejora;
use App\Models\Team;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PlanMejoraController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('plan_mejora_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PlanMejora::with(['mejora', 'responsable', 'team'])->select(sprintf('%s.*', (new PlanMejora)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'plan_mejora_show';
                $editGate = 'plan_mejora_edit';
                $deleteGate = 'plan_mejora_delete';
                $crudRoutePart = 'plan-mejoras';

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
            $table->addColumn('mejora_nombre', function ($row) {
                return $row->mejora ? $row->mejora->nombre : '';
            });

            $table->editColumn('descripcion', function ($row) {
                return $row->descripcion ? $row->descripcion : '';
            });
            $table->addColumn('responsable_name', function ($row) {
                return $row->responsable ? $row->responsable->name : '';
            });

            $table->editColumn('estatus', function ($row) {
                return $row->estatus ? PlanMejora::ESTATUS_SELECT[$row->estatus] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'mejora', 'responsable']);

            return $table->make(true);
        }

        $registromejoras = Registromejora::get();
        $users = User::getAll();
        $teams = Team::get();

        return view('admin.planMejoras.index', compact('registromejoras', 'users', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('plan_mejora_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mejoras = Registromejora::all()->pluck('nombre', 'id')->prepend(trans('global.pleaseSelect'), '');

        $responsables = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.planMejoras.create', compact('mejoras', 'responsables'));
    }

    public function store(StorePlanMejoraRequest $request)
    {
        $planMejora = PlanMejora::create($request->all());

        return redirect()->route('admin.plan-mejoras.index');
    }

    public function edit(PlanMejora $planMejora)
    {
        abort_if(Gate::denies('plan_mejora_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mejoras = Registromejora::all()->pluck('nombre', 'id')->prepend(trans('global.pleaseSelect'), '');

        $responsables = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $planMejora->load('mejora', 'responsable', 'team');

        return view('admin.planMejoras.edit', compact('mejoras', 'responsables', 'planMejora'));
    }

    public function update(UpdatePlanMejoraRequest $request, PlanMejora $planMejora)
    {
        $planMejora->update($request->all());

        return redirect()->route('admin.plan-mejoras.index');
    }

    public function show(PlanMejora $planMejora)
    {
        abort_if(Gate::denies('plan_mejora_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $planMejora->load('mejora', 'responsable', 'team');

        return view('admin.planMejoras.show', compact('planMejora'));
    }

    public function destroy(PlanMejora $planMejora)
    {
        abort_if(Gate::denies('plan_mejora_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $planMejora->delete();

        return back();
    }

    public function massDestroy(MassDestroyPlanMejoraRequest $request)
    {
        PlanMejora::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
