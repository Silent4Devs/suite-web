<?php

namespace App\Http\Controllers\admin;

use App\Exports\VistaGlobalDayOffExport;
use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\DayOff;
use App\Models\SolicitudDayOff;
use App\Models\User;
use App\Traits\ObtenerOrganizacion;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class DayOffController extends Controller
{
    use ObtenerOrganizacion;

    public function index(Request $request)
    {
        abort_if(Gate::denies('reglas_dayoff_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $query = DayOff::with('areas')->orderByDesc('id')->get();
            $table = datatables()::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'reglas_dayoff_acceder';
                $editGate = 'reglas_dayoff_editar';
                $deleteGate = 'reglas_dayoff_eliminar';
                $crudRoutePart = 'dayOff';

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
            $table->editColumn('tipo_conteo', function ($row) {
                return $row->tipo_conteo ? $row->tipo_conteo : '';
            });
            $table->editColumn('inicio_conteo', function ($row) {
                return $row->inicio_conteo ? $row->inicio_conteo : '';
            });
            $table->editColumn('dias', function ($row) {
                return $row->dias ? $row->dias : '';
            });
            $table->editColumn('incremento_dias', function ($row) {
                return $row->incremento_dias ? $row->incremento_dias : '';
            });
            $table->editColumn('periodo_corte', function ($row) {
                return $row->periodo_corte ? $row->periodo_corte : '';
            });
            $table->editColumn('afectados', function ($row) {
                return $row->afectados ? $row->afectados : '';
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

        return view('admin.dayOff.index', compact('logo_actual', 'empresa_actual'));
    }

    public function create()
    {
        abort_if(Gate::denies('reglas_dayoff_crear'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $areas = Area::getAll();
        $vacacion = new DayOff();
        $areas_seleccionadas = $vacacion->areas->pluck('id')->toArray();

        return view('admin.dayOff.create', compact('vacacion', 'areas', 'areas_seleccionadas'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('reglas_dayoff_crear'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            'nombre' => 'required|string',
            'dias' => 'required|int',
            'afectados' => 'required|int',
            'tipo_conteo' => 'required|int',
            'inicio_conteo' => 'required|int',
            'periodo_corte' => 'required|int',
        ]);

        if ($request->afectados == 2) {
            $areas = array_map(function ($value) {
                return intval($value);
            }, $request->areas);
            $vacacion = DayOff::create($request->all());
            $vacacion->areas()->sync($areas);
        } else {
            $vacacion = DayOff::create($request->all());
        }

        Alert::success('éxito', 'Información añadida con éxito');

        return redirect()->route('admin.dayOff.index');
    }

    public function show($id)
    {
        abort_if(Gate::denies('reglas_dayoff_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $vacacion = DayOff::with('areas')->find($id);

        return view('admin.dayOff.show', compact('vacacion'));
    }

    public function edit($id)
    {
        abort_if(Gate::denies('reglas_dayoff_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $areas = Area::getAll();
        $vacacion = DayOff::with('areas')->find($id);
        if (empty($vacacion)) {
            Alert::warning('warning', 'Data not found');

            return redirect(route('admin.dayOff.index'));
        }
        $areas_seleccionadas = $vacacion->areas->pluck('id')->toArray();

        return view('admin.dayOff.edit', compact('vacacion', 'areas', 'areas_seleccionadas'));
    }

    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('reglas_dayoff_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $vacacion = DayOff::find($id);

        if ($request->afectados == 2) {
            $vacacion->update($request->all());
            $areas = array_map(function ($value) {
                return intval($value);
            }, $request->areas);
            $vacacion->areas()->sync($areas);
        } else {
            $vacacion->update($request->all());
        }

        Alert::success('éxito', 'Información añadida con éxito');

        return redirect(route('admin.dayOff.index'));
    }

    public function destroy($id)
    {
        abort_if(Gate::denies('reglas_dayoff_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $vacaciones = DayOff::find($id);
        $vacaciones->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');
    }

    public function vistaGlobal(Request $request)
    {
        abort_if(Gate::denies('reglas_dayoff_vista_global'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data = User::getCurrentUser()->empleado->id;

        if ($request->ajax()) {
            $query = SolicitudDayOff::getAllwithEmpleados();
            $table = datatables()::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('empleado', function ($row) {
                return $row->empleado ? $row->empleado : '';
            });

            $table->editColumn('dias_solicitados', function ($row) {
                return $row->dias_solicitados ? $row->dias_solicitados : '';
            });
            $table->editColumn('fecha_inicio', function ($row) {
                return $row->fecha_inicio ? $row->fecha_inicio : '';
            });
            $table->editColumn('fecha_fin', function ($row) {
                return $row->fecha_fin ? $row->fecha_fin : '';
            });
            $table->editColumn('aprobacion', function ($row) {
                return $row->aprobacion ? $row->aprobacion : '';
            });
            $table->editColumn('descripcion', function ($row) {
                return $row->descripcion ? $row->descripcion : '';
            });

            $table->editColumn('año', function ($row) {
                return $row->año ? $row->año : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.dayOff.solicitudes', compact('logo_actual', 'empresa_actual'));
    }

    public function exportExcel()
    {
        $export = new VistaGlobalDayOffExport();

        return Excel::download($export, 'Control_Ausencias_DayOff.xlsx');
    }
}
