<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTratamientoRiesgoRequest;
use App\Http\Requests\StoreTratamientoRiesgoRequest;
use App\Http\Requests\UpdateTratamientoRiesgoRequest;
use App\Models\Controle;
use App\Models\Empleado;
use App\Models\Team;
use App\Models\TratamientoRiesgo;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TratamientoRiesgosController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('tratamiento_riesgo_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = TratamientoRiesgo::with(['control', 'responsable', 'team'])->select(sprintf('%s.*', (new TratamientoRiesgo)->table))->orderByDesc('id');
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'tratamiento_riesgo_show';
                $editGate = 'tratamiento_riesgo_edit';
                $deleteGate = 'tratamiento_riesgo_delete';
                $crudRoutePart = 'tratamiento-riesgos';

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
            $table->editColumn('nivelriesgo', function ($row) {
                return $row->nivelriesgo ? $row->nivelriesgo : '';
            });
            $table->addColumn('control_control', function ($row) {
                return $row->control ? $row->control->control : '';
            });

            $table->editColumn('acciones', function ($row) {
                return $row->acciones ? $row->acciones : '';
            });
            // $table->addColumn('responsable_name', function ($row) {
            //     return $row->responsable ? $row->responsable->name : '';
            // });

            $table->addColumn('id_reviso', function ($row) {
                return $row->empleado ? $row->empleado->name : '';
            });

            $table->addColumn('fechacompromiso', function ($row) {
                return $row->fechacompromiso ? $row->fechacompromiso : '';
            });

            $table->editColumn('prioridad', function ($row) {
                return $row->prioridad ? TratamientoRiesgo::PRIORIDAD_SELECT[$row->prioridad] : '';
            });
            $table->editColumn('estatus', function ($row) {
                return $row->estatus ? $row->estatus : '';
            });
            $table->editColumn('probabilidad', function ($row) {
                return $row->probabilidad ? $row->probabilidad : '';
            });
            $table->editColumn('impacto', function ($row) {
                return $row->impacto ? $row->impacto : '';
            });
            $table->editColumn('nivelriesgoresidual', function ($row) {
                return $row->nivelriesgoresidual ? $row->nivelriesgoresidual : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'control', 'responsable']);

            return $table->make(true);
        }

        $controles = Controle::get();
        $users = User::getAll();
        $teams = Team::get();

        return view('admin.tratamientoRiesgos.index', compact('controles', 'users', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('tratamiento_riesgo_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $controls = Controle::all()->pluck('control', 'id')->prepend(trans('global.pleaseSelect'), '');

        $responsables = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $empleados = Empleado::with('area')->get();

        return view('admin.tratamientoRiesgos.create', compact('controls', 'responsables', 'empleados'));
    }

    public function store(StoreTratamientoRiesgoRequest $request)
    {
        // dd($request);
        $tratamientoRiesgo = TratamientoRiesgo::create($request->all());
        // dd($tratamientoRiesgo);
        return redirect()->route('admin.tratamiento-riesgos.index')->with('success', 'Guardado con éxito');
    }

    public function edit(TratamientoRiesgo $tratamientoRiesgo)
    {
        abort_if(Gate::denies('tratamiento_riesgo_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $controls = Controle::all()->pluck('control', 'id')->prepend(trans('global.pleaseSelect'), '');

        $responsables = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tratamientoRiesgo->load('control', 'responsable', 'team');

        $empleados = Empleado::with('area')->get();

        return view('admin.tratamientoRiesgos.edit', compact('controls', 'responsables', 'tratamientoRiesgo', 'empleados'));
    }

    public function update(UpdateTratamientoRiesgoRequest $request, TratamientoRiesgo $tratamientoRiesgo)
    {
        $tratamientoRiesgo->update($request->all());

        return redirect()->route('admin.tratamiento-riesgos.index')->with('success', 'Editado con éxito');
    }

    public function show(TratamientoRiesgo $tratamientoRiesgo)
    {
        abort_if(Gate::denies('tratamiento_riesgo_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tratamientoRiesgo->load('control', 'responsable', 'team');

        return view('admin.tratamientoRiesgos.show', compact('tratamientoRiesgo'));
    }

    public function destroy(TratamientoRiesgo $tratamientoRiesgo)
    {
        abort_if(Gate::denies('tratamiento_riesgo_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tratamientoRiesgo->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');
    }

    public function massDestroy(MassDestroyTratamientoRiesgoRequest $request)
    {
        TratamientoRiesgo::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
