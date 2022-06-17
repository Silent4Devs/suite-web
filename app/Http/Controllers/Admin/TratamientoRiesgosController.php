<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTratamientoRiesgoRequest;
use App\Http\Requests\StoreTratamientoRiesgoRequest;
use App\Http\Requests\UpdateTratamientoRiesgoRequest;
use App\Models\DeclaracionAplicabilidad;
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
        abort_if(Gate::denies('tratamiento_de_los_riesgos_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = TratamientoRiesgo::with(['control', 'responsable', 'team'])->select(sprintf('%s.*', (new TratamientoRiesgo)->table))->orderByDesc('id');
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'tratamiento_de_los_riesgos_ver';
                $editGate = 'tratamiento_de_los_riesgos_editar';
                $deleteGate = 'tratamiento_de_los_riesgos_eliminar';
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
            $table->addColumn('control_id', function ($row) {
                return $row->control ? $row->control->anexo_politica : '';
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

        $controles = DeclaracionAplicabilidad::get();
        $users = User::get();
        $teams = Team::get();

        return view('admin.tratamientoRiesgos.index', compact('controles', 'users', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('tratamiento_de_los_riesgos_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $controls = DeclaracionAplicabilidad::with('control')->get();
        $responsables = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $empleados = Empleado::alta()->with('area')->get();

        return view('admin.tratamientoRiesgos.create', compact('controls', 'responsables', 'empleados'));
    }

    public function store(StoreTratamientoRiesgoRequest $request)
    {
        abort_if(Gate::denies('tratamiento_de_los_riesgos_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // dd($request);
        $tratamientoRiesgo = TratamientoRiesgo::create($request->all());
        // dd($tratamientoRiesgo);
        return redirect()->route('admin.tratamiento-riesgos.index')->with('success', 'Guardado con éxito');
    }

    public function edit($tratamientos)
    {
        abort_if(Gate::denies('tratamiento_de_los_riesgos_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tratamientos = TratamientoRiesgo::find($tratamientos);
        $controls = DeclaracionAplicabilidad::with('control')->get();
        $responsables = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $empleados = Empleado::alta()->with('area')->get();

        return view('admin.tratamientoRiesgos.edit', compact('tratamientos', 'controls', 'responsables', 'empleados'));
    }

    public function update(UpdateTratamientoRiesgoRequest $request, TratamientoRiesgo $tratamientoRiesgo)
    {
        abort_if(Gate::denies('tratamiento_de_los_riesgos_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tratamientoRiesgo->update($request->all());

        return redirect()->route('admin.tratamiento-riesgos.index')->with('success', 'Editado con éxito');
    }

    public function show(TratamientoRiesgo $tratamientoRiesgo)
    {
        abort_if(Gate::denies('tratamiento_de_los_riesgos_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tratamientoRiesgo->load('control', 'responsable', 'team');

        return view('admin.tratamientoRiesgos.show', compact('tratamientoRiesgo'));
    }

    public function destroy(TratamientoRiesgo $tratamientoRiesgo)
    {
        abort_if(Gate::denies('tratamiento_de_los_riesgos_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tratamientoRiesgo->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');
    }

    public function massDestroy(MassDestroyTratamientoRiesgoRequest $request)
    {
        TratamientoRiesgo::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
