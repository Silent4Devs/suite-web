<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Empleado;
use App\Models\IncidentesDayoff;
use App\Models\Puesto;
use App\Traits\ObtenerOrganizacion;
use Carbon\Carbon;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class IncidentesDayOffController extends Controller
{
    use ObtenerOrganizacion;

    public function index(Request $request)
    {
        abort_if(Gate::denies('incidentes_dayoff_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $query = IncidentesDayoff::getAll();
            $table = datatables()::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'amenazas_ver';
                $editGate = 'amenazas_editar';
                $deleteGate = 'amenazas_eliminar';
                $crudRoutePart = 'incidentes-dayoff';

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

        return view('admin.incidentesDayoff.index', compact('logo_actual', 'empresa_actual'));
    }

    public function create()
    {
        abort_if(Gate::denies('incidentes_dayoff_crear'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $vacacion = new IncidentesDayOff();
        $empleados = Empleado::getAltaEmpleados();
        $puestos = Puesto::getAll();
        $areas = Area::getAll();
        $empleados_seleccionados = $vacacion->empleados->pluck('id')->toArray();
        $puestos_seleccionados = $vacacion->puestos->pluck('id')->toArray();
        $areas_seleccionadas = $vacacion->areas->pluck('id')->toArray();
        $año = Carbon::now()->format('Y');

        return view('admin.incidentesDayoff.create', compact(
            'vacacion',
            'empleados',
            'empleados_seleccionados',
            'puestos',
            'puestos_seleccionados',
            'areas',
            'areas_seleccionadas',
            'año'
        ));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('incidentes_dayoff_crear'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            'nombre' => 'required|string|max:255',
            'dias_aplicados' => 'required|int|gte:1|max:365',
            'aniversario' => 'required|int|gte:1',
            'efecto' => 'required|int',
        ]);

        $empleados = $request->has('empleados') ? $request->empleados : [];
        $puestos = $request->has('puestos') ? $request->puestos : [];
        $areas = $request->has('areas') ? $request->areas : [];

        // Check if at least one array has data
        if (empty($empleados) && empty($puestos) && empty($areas)) {
            $errorMessage = 'Debe seleccionar al menos una opción sobre a quien aplicara la excepción.';

            // Manually add error message to $errors bag
            $errors = new \Illuminate\Support\MessageBag();
            $errors->add('custom_error', $errorMessage);

            // Redirect back with the input data and errors
            return redirect()->back()->withErrors($errors)->withInput();
        }

        if (!empty($empleados)) {
            $empleados = array_map(function ($value) {
                return intval($value);
            }, $request->empleados);
        }

        if (!empty($puestos)) {
            $puestos = array_map(function ($value) {
                return intval($value);
            }, $request->puestos);
        }

        if (!empty($areas)) {
            $areas = array_map(function ($value) {
                return intval($value);
            }, $request->areas);
        }

        $vacacion = IncidentesDayOff::create($request->all());
        $vacacion->empleados()->sync($empleados);
        $vacacion->puestos()->sync($puestos);
        $vacacion->areas()->sync($areas);

        Flash::success('Incidencia añadida satisfactoriamente.');

        return redirect()->route('admin.incidentes-dayoff.index');
    }

    public function show($id)
    {
        abort_if(Gate::denies('incidentes_dayoff_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $vacacion = IncidentesDayoff::with('empleados')->find($id);

        return view('admin.incidentesDayoff.show', compact('vacacion'));
    }

    public function edit($id)
    {
        abort_if(Gate::denies('incidentes_dayoff_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $empleados = Empleado::getAltaEmpleados();
        $puestos = Puesto::getAll();
        $areas = Area::getAll();
        $vacacion = IncidentesDayoff::with('empleados', 'puestos', 'areas')->find($id);

        if (empty($vacacion)) {
            Flash::error('Excepción not found');

            return redirect(route('admin.incidentes-dayoff'));
        }

        $empleados_seleccionados = $vacacion->empleados->pluck('id')->toArray();
        $puestos_seleccionados = $vacacion->puestos->pluck('id')->toArray();
        $areas_seleccionadas = $vacacion->areas->pluck('id')->toArray();

        return view('admin.incidentesDayoff.edit', compact(
            'vacacion',
            'empleados',
            'empleados_seleccionados',
            'puestos',
            'puestos_seleccionados',
            'areas',
            'areas_seleccionadas',
        ));
    }

    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('incidentes_dayoff_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            'nombre' => 'required|string|max:255',
            'dias_aplicados' => 'required|int|gte:1|max:365',
            'aniversario' => 'required|int|gte:1',
            'efecto' => 'required|int',
        ]);

        $empleados = $request->has('empleados') ? $request->empleados : [];
        $puestos = $request->has('puestos') ? $request->puestos : [];
        $areas = $request->has('areas') ? $request->areas : [];

        // Check if at least one array has data
        if (empty($empleados) && empty($puestos) && empty($areas)) {
            $errorMessage = 'Debe seleccionar al menos una opción sobre a quien aplicara la excepción.';

            // Manually add error message to $errors bag
            $errors = new \Illuminate\Support\MessageBag();
            $errors->add('custom_error', $errorMessage);

            // Redirect back with the input data and errors
            return redirect()->back()->withErrors($errors)->withInput();
        }

        $vacacion = IncidentesDayoff::find($id);

        $vacacion->update($request->all());
        if (!empty($empleados)) {
            $empleados = array_map(function ($value) {
                return intval($value);
            }, $request->empleados);
        }

        if (!empty($puestos)) {
            $puestos = array_map(function ($value) {
                return intval($value);
            }, $request->puestos);
        }

        if (!empty($areas)) {
            $areas = array_map(function ($value) {
                return intval($value);
            }, $request->areas);
        }

        $vacacion->empleados()->sync($empleados);
        $vacacion->puestos()->sync($puestos);
        $vacacion->areas()->sync($areas);


        Flash::success('Excepción de Day Off actualizada.');

        return redirect(route('admin.incidentes-dayoff.index'));
    }

    public function destroy($id)
    {
        dd($id);
        abort_if(Gate::denies('incidentes_dayoff_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $vacaciones = IncidentesDayoff::find($id);
        $vacaciones->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');
    }
}
