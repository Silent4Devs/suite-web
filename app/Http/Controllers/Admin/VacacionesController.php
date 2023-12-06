<?php

namespace App\Http\Controllers\admin;

use App\Exports\VistaGlobalVacacionesExport;
use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\SolicitudVacaciones;
use App\Models\User;
use App\Models\Vacaciones;
use App\Traits\ObtenerOrganizacion;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class VacacionesController extends Controller
{
    use ObtenerOrganizacion;

    public function index(Request $request)
    {
        abort_if(Gate::denies('reglas_vacaciones_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $query = Vacaciones::with('areas')->orderByDesc('id')->get();
            $table = datatables()::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'reglas_vacaciones_acceder';
                $editGate = 'reglas_vacaciones_editar';
                $deleteGate = 'reglas_vacaciones_eliminar';
                $crudRoutePart = 'vacaciones';

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
            $table->editColumn('fin_conteo', function ($row) {
                return $row->fin_conteo ? $row->fin_conteo : '';
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

        return view('admin.vacaciones.index', compact('logo_actual', 'empresa_actual'));
    }

    public function create()
    {
        abort_if(Gate::denies('reglas_vacaciones_crear'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $areas = Area::getAll();
        $vacacion = new Vacaciones();
        $areas_seleccionadas = $vacacion->areas->pluck('id')->toArray();

        return view('admin.vacaciones.create', compact('vacacion', 'areas', 'areas_seleccionadas'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('reglas_vacaciones_crear'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            'nombre' => 'required|string|max:255',
            'dias' => 'required|int|gte:1|lte:24',
            'afectados' => 'required|int',
            'tipo_conteo' => 'required|int',
            'inicio_conteo' => 'required|int|gte:1',
            'fin_conteo' => 'required|int|gte:inicio_conteo',
            'periodo_corte' => 'required|int',
        ]);

        if ($request->afectados == 2) {
            $areas = array_map(function ($value) {
                return intval($value);
            }, $request->areas);
            $vacacion = Vacaciones::create($request->all());
            $vacacion->areas()->sync($areas);
        } else {
            $vacacion = Vacaciones::create($request->all());
        }

        Alert::success('éxito', 'Información añadida con éxito');

        return redirect()->route('admin.vacaciones.index');
    }

    public function show($id)
    {
        abort_if(Gate::denies('reglas_vacaciones_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $vacacion = Vacaciones::with('areas')->find($id);

        return view('admin.vacaciones.show', compact('vacacion'));
    }

    public function edit($id)
    {
        abort_if(Gate::denies('reglas_vacaciones_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $areas = Area::getAll();
        $vacacion = Vacaciones::with('areas')->find($id);
        if (empty($vacacion)) {
            Alert::warning('warning', 'Data not found');

            return redirect(route('admin.vacaciones.index'));
        }
        $areas_seleccionadas = $vacacion->areas->pluck('id')->toArray();

        return view('admin.vacaciones.edit', compact('vacacion', 'areas', 'areas_seleccionadas'));
    }

    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('reglas_vacaciones_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            'nombre' => 'required|string|max:255',
            'dias' => 'required|int|gte:1|lte:24',
            'afectados' => 'required|int',
            'tipo_conteo' => 'required|int',
            'inicio_conteo' => 'required|int|gte:1',
            'fin_conteo' => 'required|int|gte:inicio_conteo',
            'periodo_corte' => 'required|int',
        ]);

        $vacacion = Vacaciones::find($id);

        if ($request->afectados == 2) {
            $vacacion->update($request->all());
            $areas = array_map(function ($value) {
                return intval($value);
            }, $request->areas);
            $vacacion->areas()->sync($areas);
        } else {
            $vacacion->update($request->all());
        }

        Alert::success('éxito', 'Información actualizada con éxito');

        return redirect(route('admin.vacaciones.index'));
    }

    public function destroy($id)
    {
        abort_if(Gate::denies('reglas_vacaciones_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $vacaciones = Vacaciones::find($id);
        $vacaciones->delete();
        Alert::success('éxito', 'Información eliminada con éxito');

        return back()->with('deleted', 'Registro eliminado con éxito');
    }

    public function vistaGlobal(Request $request)
    {
        abort_if(Gate::denies('reglas_vacaciones_vista_global'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data = User::getCurrentUser()->empleado->id;

        $solVac = SolicitudVacaciones::getAllwithEmpleados();
        // dd($solVac);

        // if ($request->ajax()) {
        //     $query = SolicitudVacaciones::getAllwithEmpleados();
        //     $table = datatables()::of($query);

        //     $table->addColumn('placeholder', '&nbsp;');
        //     $table->addColumn('actions', '&nbsp;');

        //     $table->editColumn('empleado', function ($row) {
        //         return $row->empleado ? $row->empleado : '';
        //     });

        //     $table->editColumn('dias_solicitados', function ($row) {
        //         return $row->dias_solicitados ? $row->dias_solicitados : '';
        //     });
        //     $table->editColumn('fecha_inicio', function ($row) {
        //         return $row->fecha_inicio ? $row->fecha_inicio : '';
        //     });
        //     $table->editColumn('fecha_fin', function ($row) {
        //         return $row->fecha_fin ? $row->fecha_fin : '';
        //     });
        //     $table->editColumn('aprobacion', function ($row) {
        //         return $row->aprobacion ? $row->aprobacion : '';
        //     });
        //     $table->editColumn('descripcion', function ($row) {
        //         return $row->descripcion ? $row->descripcion : '';
        //     });

        //     $table->rawColumns(['actions', 'placeholder']);

        //     return $query;
        // }

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.vacaciones.solicitudes', compact('logo_actual', 'empresa_actual', 'solVac'));
    }

    public function exportExcel()
    {
        $export = new VistaGlobalVacacionesExport();

        return Excel::download($export, 'Control_Ausencias_Vacaciones.xlsx');
    }
}
