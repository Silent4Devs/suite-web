<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Empleado;
use App\Models\IncidentesDayoff;
use App\Models\IncidentesVacaciones;
use App\Models\Organizacion;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class IncidentesVacacionesController extends Controller
{
    
    public function index(Request $request)
    {
        abort_if(Gate::denies('amenazas_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $query = IncidentesVacaciones::with('empleados')->orderByDesc('id')->get();
            $table = datatables()::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'amenazas_ver';
                $editGate = 'amenazas_editar';
                $deleteGate = 'amenazas_eliminar';
                $crudRoutePart = 'incidentes-vacaciones';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('nombre', function ($row) {
                return $row->nombre ? $row->nombre : '';
            });
            $table->editColumn('dias_aplicados', function ($row) {
                return $row->dias_aplicados ? $row->dias_aplicados : '';
            });
            $table->editColumn('aniversario', function ($row) {
                return $row->aniversario ? $row->aniversario : '';
            });
            $table->editColumn('efecto', function ($row) {
                return $row->efecto ? $row->efecto : '';
            });
           
            $table->editColumn('descripcion', function ($row) {
                return $row->descripcion ? $row->descripcion : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }
        $organizacion_actual = Organizacion::select('empresa', 'logotipo')->first();
        if (is_null($organizacion_actual)) {
            $organizacion_actual = new Organizacion();
            $organizacion_actual->logotipo = asset('img/logo.png');
            $organizacion_actual->empresa = 'Silent4Business';
        }
        $logo_actual = $organizacion_actual->logotipo;
        $empresa_actual = $organizacion_actual->empresa;
        return view('admin.incidentesVacaciones.index', compact('logo_actual', 'empresa_actual'));
    }


    public function create()
    {
        $vacacion = new IncidentesVacaciones();
        $empleados = Empleado::get();
        $empleados_seleccionados = $vacacion->empleados->pluck('id')->toArray();
       
        return view('admin.incidentesVacaciones.create', compact('vacacion','empleados','empleados_seleccionados'));
    }


    public function store(Request $request)
    {
        abort_if(Gate::denies('amenazas_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            'nombre' => 'required|string',
            'dias_aplicados' => 'required|int',
            'aniversario' => 'required|int',
            'efecto' => 'required|int',
        ]);

            $empleados = array_map(function ($value) {
                return intval($value);
            }, $request->empleados);
            $vacacion = IncidentesVacaciones::create($request->all());
            $vacacion->empleados()->sync($empleados);


        Flash::success('Excepción añadida satisfactoriamente.');

        return redirect()->route('admin.incidentes-vacaciones.index');
    }


    public function show($id)
    {
        abort_if(Gate::denies('amenazas_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $vacacion = IncidentesVacaciones::with('empleados')->find($id);

        return view('admin.incidentesVacaciones.show', compact('vacacion'));
    }


    public function edit($id)
    {
        $empleados = Empleado::get();
        $vacacion = IncidentesVacaciones::with('empleados')->find($id);
        if (empty($vacacion)) {
            Flash::error('Excepción not found');

            return redirect(route('admin.incidentes-dayoff'));
        }
        $empleados_seleccionados = $vacacion->empleados->pluck('id')->toArray();

        return view('admin.vacaciones.edit', compact('vacacion','empleados','empleados_seleccionados'));
    }


    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('amenazas_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            'nombre' => 'required|string',
            'dias_aplicados' => 'required|int',
            'aniversario' => 'required|int',
            'efecto' => 'required|int',
        ]);

        $vacacion = IncidentesVacaciones::find($id);

        $vacacion->update($request->all());
        $empleados = array_map(function ($value) {
            return intval($value);
        }, $request->empleados);
        $vacacion->empleados()->sync($empleados);

        Flash::success('Excepción de Vacaciones actualizada.');

        return redirect(route('admin.incidentes-vacaciones.index'));
    }


    public function destroy($id)
    {
        $vacaciones = IncidentesVacaciones::find($id);
        $vacaciones->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');
    }
}
