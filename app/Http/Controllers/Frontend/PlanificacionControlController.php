<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPlanificacionControlRequest;
use App\Http\Requests\StorePlanificacionControlRequest;
use App\Http\Requests\UpdatePlanificacionControlRequest;
use App\Models\Empleado;
use App\Models\PlanificacionControl;
use App\Models\Team;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PlanificacionControlController extends Controller
{
    public function index(Request $request)
    {
        //        abort_if(Gate::denies('planificacion_control_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PlanificacionControl::with(['dueno', 'team'])->select(sprintf('%s.*', (new PlanificacionControl)->table))->orderByDesc('id');
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'planificacion_control_show';
                $editGate = 'planificacion_control_edit';
                $deleteGate = 'planificacion_control_delete';
                $crudRoutePart = 'planificacion-controls';

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
            $table->editColumn('activo', function ($row) {
                return $row->activo ? $row->activo : '';
            });
            $table->editColumn('descripcion', function ($row) {
                return $row->descripcion ? $row->descripcion : '';
            });
            // $table->addColumn('dueno_name', function ($row) {
            //     return $row->dueno ? $row->dueno->name : '';
            // });

            $table->addColumn('id_reviso', function ($row) {
                return $row->empleado ? $row->empleado->name : '';
            });

            $table->editColumn('vulnerabilidad', function ($row) {
                return $row->vulnerabilidad ? $row->vulnerabilidad : '';
            });
            $table->editColumn('amenaza', function ($row) {
                return $row->amenaza ? $row->amenaza : '';
            });
            $table->editColumn('confidencialidad', function ($row) {
                return $row->confidencialidad ? $row->confidencialidad : '';
            });
            $table->editColumn('integridad', function ($row) {
                return $row->integridad ? $row->integridad : '';
            });
            $table->editColumn('disponibilidad', function ($row) {
                return $row->disponibilidad ? $row->disponibilidad : '';
            });
            $table->editColumn('probabilidad', function ($row) {
                return $row->probabilidad ? $row->probabilidad : '';
            });
            $table->editColumn('impacto', function ($row) {
                return $row->impacto ? $row->impacto : '';
            });
            $table->editColumn('nivelriesgo', function ($row) {
                return $row->nivelriesgo ? $row->nivelriesgo : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'dueno']);

            return $table->make(true);
        }

        $users = User::getAll();
        $teams = Team::get();

        return view('admin.planificacionControls.index', compact('users', 'teams'));
    }

    public function create()
    {
        //        abort_if(Gate::denies('planificacion_control_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $duenos = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $empleados = Empleado::with('area')->get();

        return view('admin.planificacionControls.create', compact('duenos', 'empleados'));
    }

    public function store(StorePlanificacionControlRequest $request)
    {
        $planificacionControl = PlanificacionControl::create($request->all());

        return redirect()->route('admin.planificacion-controls.index')->with('success', 'Guardado con éxito');
    }

    public function edit(PlanificacionControl $planificacionControl)
    {
        //        abort_if(Gate::denies('planificacion_control_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $duenos = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $empleados = Empleado::with('area')->get();

        $planificacionControl->load('dueno', 'team');

        return view('admin.planificacionControls.edit', compact('duenos', 'planificacionControl', 'empleados'));
    }

    public function update(UpdatePlanificacionControlRequest $request, PlanificacionControl $planificacionControl)
    {
        $planificacionControl->update($request->all());

        return redirect()->route('admin.planificacion-controls.index')->with('success', 'Editado con éxito');
    }

    public function show(PlanificacionControl $planificacionControl)
    {
        //        abort_if(Gate::denies('planificacion_control_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $planificacionControl->load('dueno', 'team');

        return view('admin.planificacionControls.show', compact('planificacionControl'));
    }

    public function destroy(PlanificacionControl $planificacionControl)
    {
        //        abort_if(Gate::denies('planificacion_control_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $planificacionControl->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');
    }

    public function massDestroy(MassDestroyPlanificacionControlRequest $request)
    {
        PlanificacionControl::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
