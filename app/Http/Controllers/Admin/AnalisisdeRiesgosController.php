<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnalisisDeRiesgo;
use App\Models\Area;
use App\Models\Empleado;
use App\Traits\ObtenerOrganizacion;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Laracasts\Flash\Flash;
use Yajra\DataTables\Facades\DataTables;

class AnalisisdeRiesgosController extends Controller
{
    use ObtenerOrganizacion;

    public function menu()
    {
        // abort_if(Gate::denies('menu_analisis_riesgo_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.analisis-riesgos.menu-buttons');
    }

    public function index(Request $request)
    {
        abort_if(Gate::denies('matriz_de_riesgo_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            //Esta es el error , activo_id no lo encuentra, hay que modificar la relacion en el modelo de matrizriesgo
            $query = AnalisisDeRiesgo::orderByDesc('id')->get();
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'matriz_de_riesgo_ver';
                $editGate = 'matriz_de_riesgo_editar';
                $deleteGate = 'matriz_de_riesgo_eliminar';
                $crudRoutePart = 'analisis-riesgos';

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

            $table->editColumn('tipo', function ($row) {
                return $row->tipo ? $row->tipo : '';
            });

            $table->editColumn('fecha', function ($row) {
                return $row->fecha ? \Carbon\Carbon::parse($row->fecha)->format('d-m-Y') : '';
            });

            $table->editColumn('porcentaje_implementacion', function ($row) {
                return $row->porcentaje_implementacion ? $row->porcentaje_implementacion : '';
            });

            $table->editColumn('elaboro', function ($row) {
                return $row->empleado ? $row->empleado->name : '';
            });

            $table->editColumn('estatus', function ($row) {
                if ($row->estatus == 1) {
                    return $row->estatus ? 'En proceso' : '';
                } elseif ($row->estatus == 2) {
                    return $row->estatus ? 'En revisión' : '';
                } else {
                    return $row->estatus ? 'Aprobado' : '';
                }
            });
            $table->editColumn('enlace', function ($row) {
                return $row->id ? $row->id : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'activo_id', 'controles']);

            return $table->make(true);
        }

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.analisis-riesgos.index', compact('empresa_actual', 'logo_actual'));
    }

    public function create()
    {
        abort_if(Gate::denies('matriz_de_riesgo_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $empleados = Empleado::getaltaAll();

        //$tipoactivos = Tipoactivo::all()->pluck('tipo', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.analisis-riesgos.create', compact('empleados'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('matriz_de_riesgo_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $analisis = AnalisisDeRiesgo::create($request->all());
        switch ($request->tipo) {
            case 'Seguridad de la información':
                Flash::success('<h5 class="text-center">Análisis de riesgo agregado</h5>');

                return redirect()->route('admin.matriz-seguridad', ['id' => $analisis->id]);
                break;
            default:
                Flash::error('<h5 class="text-center">Ocurrio un error intente de nuevo</h5>');

                return redirect()->route('admin.analisis-riesgos.index');
        }
    }

    public function show(Request $request, $id)
    {
        abort_if(Gate::denies('matriz_de_riesgo_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $analisis = AnalisisDeRiesgo::find($id);

        return view('admin.analisis-riesgos.show', compact('analisis'));
    }

    public function edit($id)
    {
        abort_if(Gate::denies('matriz_de_riesgo_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $empleados = Empleado::getaltaAll();
        $analisis = AnalisisDeRiesgo::find($id);

        return view('admin.analisis-riesgos.edit', compact('empleados', 'analisis'));
    }

    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('matriz_de_riesgo_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $analisis = AnalisisDeRiesgo::find($id);

        $analisis->update([
            'nombre' => $request->nombre,
            'tipo' => $request->tipo,
            'fecha' => $request->fecha,
            'id_elaboro' => $request->id_elaboro,
            'porcentaje_implementacion' => $request->porcentaje_implementacion,
            'estatus' => $request->estatus,
        ]);

        return redirect()->route('admin.analisis-riesgos.index')->with('success', 'Editado con éxito');
    }

    public function destroy($id)
    {
        abort_if(Gate::denies('matriz_de_riesgo_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $analisis = AnalisisDeRiesgo::find($id);
        $analisis->delete();

        return redirect()->route('admin.analisis-riesgos.index')->with('success', 'Eliminado con éxito');
    }

    public function getEmployeeData(Request $request)
    {
        $empleados = Empleado::getaltaAll()->find($request->id);
        $areas = Area::find($empleados->area_id);

        return response()->json(['puesto' => $empleados->puesto, 'area' => $areas->area]);
    }
}
