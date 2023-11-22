<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Empleado;
use App\Models\IncidentesDayoff;
use App\Traits\ObtenerOrganizacion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use RealRashid\SweetAlert\Facades\Alert;

class IncidentesDayOffController extends Controller
{
    use ObtenerOrganizacion;

    public function index(Request $request)
    {
        abort_if(Gate::denies('incidentes_dayoff_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $query = IncidentesDayoff::with('empleados')->orderByDesc('id')->get();
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
        $empleados = Empleado::getAll();
        $empleados_seleccionados = $vacacion->empleados->pluck('id')->toArray();
        $año = Carbon::now()->format('Y');

        return view('admin.incidentesDayoff.create', compact('vacacion', 'empleados', 'empleados_seleccionados', 'año'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('incidentes_dayoff_crear'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            'nombre' => 'required|string',
            'dias_aplicados' => 'required|int',
            'aniversario' => 'required|int',
            'efecto' => 'required|int',
        ]);

        $empleados = array_map(function ($value) {
            return intval($value);
        }, $request->empleados);
        $vacacion = IncidentesDayOff::create($request->all());
        $vacacion->empleados()->sync($empleados);

        Alert::success('éxito', 'Información añadida con éxito');

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
        $empleados = Empleado::getAll();
        $vacacion = IncidentesDayoff::with('empleados')->find($id);
        if (empty($vacacion)) {
            Alert::warning('warning', 'Data not found');

            return redirect(route('admin.incidentes-dayoff'));
        }
        $empleados_seleccionados = $vacacion->empleados->pluck('id')->toArray();

        return view('admin.incidentesDayoff.edit', compact('vacacion', 'empleados', 'empleados_seleccionados'));
    }

    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('incidentes_dayoff_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            'nombre' => 'required|string',
            'dias_aplicados' => 'required|int',
            'aniversario' => 'required|int',
            'efecto' => 'required|int',
        ]);

        $vacacion = IncidentesDayoff::find($id);

        $vacacion->update($request->all());
        $empleados = array_map(function ($value) {
            return intval($value);
        }, $request->empleados);
        $vacacion->empleados()->sync($empleados);

        Alert::success('éxito', 'Información añadida con éxito');

        return redirect(route('admin.incidentes-dayoff.index'));
    }

    public function destroy($id)
    {
        abort_if(Gate::denies('incidentes_dayoff_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $vacaciones = IncidentesDayoff::find($id);
        $vacaciones->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');
    }
}
