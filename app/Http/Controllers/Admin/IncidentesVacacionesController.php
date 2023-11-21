<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Empleado;
use App\Models\IncidentesVacaciones;
use App\Models\Puesto;
use App\Traits\ObtenerOrganizacion;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class IncidentesVacacionesController extends Controller
{
    use ObtenerOrganizacion;

    public function index(Request $request)
    {
        abort_if(Gate::denies('incidentes_vacaciones_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            //Se le quito la relacion a empleados porque no es necesaria
            $query = IncidentesVacaciones::getAll();
            $table = datatables()::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'incidentes_vacaciones_crear';
                $editGate = 'incidentes_vacaciones_editar';
                $deleteGate = 'incidentes_vacaciones_eliminar';
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

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.incidentesVacaciones.index', compact('logo_actual', 'empresa_actual'));
    }

    public function create()
    {
        abort_if(Gate::denies('incidentes_vacaciones_crear'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $vacacion = new IncidentesVacaciones();
        $empleados = Empleado::getAltaEmpleados();
        $puestos = Puesto::getAll();
        $areas = Area::getAll();
        $empleados_seleccionados = $vacacion->empleados->pluck('id')->toArray();
        $puestos_seleccionados = $vacacion->puestos->pluck('id')->toArray();
        $areas_seleccionadas = $vacacion->areas->pluck('id')->toArray();

        return view('admin.incidentesVacaciones.create', compact(
            'vacacion',
            'empleados',
            'empleados_seleccionados',
            'puestos',
            'puestos_seleccionados',
            'areas',
            'areas_seleccionadas'
        ));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('incidentes_vacaciones_crear'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // dd($request->all());
        $request->validate([
            'nombre' => 'required|string',
            'dias_aplicados' => 'required|int',
            'aniversario' => 'required|int',
            'efecto' => 'required|int',
        ]);

        $empleados = array_map(function ($value) {
            return intval($value);
        }, $request->empleados);

        $puestos = array_map(function ($value) {
            return intval($value);
        }, $request->puestos);

        $areas = array_map(function ($value) {
            return intval($value);
        }, $request->areas);

        $vacacion = IncidentesVacaciones::create($request->all());
        $vacacion->empleados()->sync($empleados);
        $vacacion->puestos()->sync($puestos);
        $vacacion->areas()->sync($areas);


        Flash::success('Excepción añadida satisfactoriamente.');

        return redirect()->route('admin.incidentes-vacaciones.index');
    }

    public function show($id)
    {
        abort_if(Gate::denies('incidentes_vacaciones_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $vacacion = IncidentesVacaciones::with('empleados')->find($id);

        return view('admin.incidentesVacaciones.show', compact('vacacion'));
    }

    public function edit($id)
    {
        abort_if(Gate::denies('incidentes_vacaciones_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $empleados = Empleado::getAltaEmpleados();
        $puestos = Puesto::getAll();
        $areas = Area::getAll();
        $vacacion = IncidentesVacaciones::with('empleados', 'puestos', 'areas')->find($id);

        if (empty($vacacion)) {
            Flash::error('Excepción not found');

            return redirect(route('admin.incidentes-dayoff'));
        }
        $empleados_seleccionados = $vacacion->empleados->pluck('id')->toArray();
        $puestos_seleccionados = $vacacion->puestos->pluck('id')->toArray();
        $areas_seleccionadas = $vacacion->areas->pluck('id')->toArray();

        return view('admin.incidentesVacaciones.edit', compact(
            'vacacion',
            'empleados',
            'empleados_seleccionados',
            'puestos',
            'puestos_seleccionados',
            'areas',
            'areas_seleccionadas'
        ));
    }

    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('incidentes_vacaciones_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
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

        $puestos = array_map(function ($value) {
            return intval($value);
        }, $request->puestos);

        $areas = array_map(function ($value) {
            return intval($value);
        }, $request->areas);

        $vacacion->empleados()->sync($empleados);
        $vacacion->puestos()->sync($puestos);
        $vacacion->areas()->sync($areas);

        Flash::success('Excepción de Vacaciones actualizada.');

        return redirect(route('admin.incidentes-vacaciones.index'));
    }

    public function destroy($id)
    {
        abort_if(Gate::denies('incidentes_vacaciones_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $vacaciones = IncidentesVacaciones::find($id);
        $vacaciones->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');
    }
}
