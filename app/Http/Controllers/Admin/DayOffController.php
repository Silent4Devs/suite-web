<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\DayOff;
use App\Models\Organizacion;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class DayOffController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('amenazas_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $query = DayOff::with('areas')->orderByDesc('id')->get();
            $table = datatables()::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'amenazas_ver';
                $editGate = 'amenazas_editar';
                $deleteGate = 'amenazas_eliminar';
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
        $organizacion_actual = Organizacion::select('empresa', 'logotipo')->first();
        if (is_null($organizacion_actual)) {
            $organizacion_actual = new Organizacion();
            $organizacion_actual->logotipo = asset('img/logo.png');
            $organizacion_actual->empresa = 'Silent4Business';
        }
        $logo_actual = $organizacion_actual->logotipo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.dayOff.index', compact('logo_actual', 'empresa_actual'));
    }

    public function create()
    {
        $areas = Area::get();
        $vacacion = new DayOff();
        $areas_seleccionadas = $vacacion->areas->pluck('id')->toArray();

        return view('admin.dayOff.create', compact('vacacion', 'areas', 'areas_seleccionadas'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('amenazas_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'nombre' => 'required|string',
            'dias' => 'required|int',
            'afectados' => 'required|int',
            'tipo_conteo' => 'required|int',
            'inicio_conteo' => 'required|int',
            'incremento_dias' => 'required|int',
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

        Flash::success('Regla Days Off´s añadida satisfactoriamente.');

        return redirect()->route('admin.dayOff.index');
    }

    public function show($id)
    {
        $vacacion = DayOff::with('areas')->find($id);

        return view('admin.dayOff.show', compact('vacacion'));
    }

    public function edit($id)
    {
        abort_if(Gate::denies('amenazas_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $areas = Area::get();
        $vacacion = DayOff::with('areas')->find($id);
        if (empty($vacacion)) {
            Flash::error('Days Off´s not found');

            return redirect(route('admin.dayOff.index'));
        }
        $areas_seleccionadas = $vacacion->areas->pluck('id')->toArray();

        return view('admin.dayOff.edit', compact('vacacion', 'areas', 'areas_seleccionadas'));
    }

    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('amenazas_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
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

        Flash::success('Regla Days Off´s actualizada.');

        return redirect(route('admin.dayOff.index'));
    }

    public function destroy($id)
    {
        $vacaciones = DayOff::find($id);
        $vacaciones->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');
    }
}
