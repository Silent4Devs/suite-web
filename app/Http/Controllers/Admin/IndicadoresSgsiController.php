<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyIndicadoresSgsiRequest;
use App\Models\Area;
use App\Models\DashboardIndicadorSG;
use App\Models\Empleado;
use App\Models\IndicadoresSgsi;
use App\Models\Proceso;
use App\Models\Team;
use App\Models\User;
use App\Models\VariablesIndicador;
use App\Traits\ObtenerOrganizacion;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class IndicadoresSgsiController extends Controller
{
    use ObtenerOrganizacion;

    public function index(Request $request)
    {
        abort_if(Gate::denies('indicadores_sgsi_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $area_empleado = auth()->user()->empleado->area->id;
        $isAdmin = in_array('Admin', auth()->user()->roles->pluck('title')->toArray());
        if ($request->ajax()) {
            if ($isAdmin) {
                $query = IndicadoresSgsi::orderBy('id')->get();
            } else {
                $query = IndicadoresSgsi::where('id_area', $area_empleado)->orderBy('id')->get();
            }

            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'indicadores_sgsi_ver';
                $editGate = 'indicadores_sgsi_editar';
                $deleteGate = 'indicadores_sgsi_eliminar';
                $crudRoutePart = 'indicadores-sgsis';

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

            $table->editColumn('area', function ($row) {
                return $row->area ? $row->area->area : 'n/a';
            });

            $table->editColumn('responsable_name', function ($row) {
                return $row->empleado ? $row->empleado : '';
            });

            $table->editColumn('año', function ($row) {
                return $row->ano ? $row->ano : '';
            });

            $table->editColumn('descripcion', function ($row) {
                return $row->descripcion ? $row->descripcion : '';
            });

            $table->editColumn('formula', function ($row) {
                return $row->formula ? $row->formula : '';
            });

            $table->editColumn('unidadmedida', function ($row) {
                return $row->unidadmedida ? $row->unidadmedida : '';
            });

            $table->editColumn('frecuencia', function ($row) {
                return $row->frecuencia ? $row->frecuencia : '';
            });

            $table->editColumn('enlace', function ($row) {
                return $row->id ? $row->id : '';
            });

            /*$table->editColumn('meta', function ($row) {
                return $row->meta ? $row->meta : "";
            });

            $table->editColumn('responsable', function ($row) {
                return $row->id_empleado ? $row->id_empleado : "";
            });*/

            $table->rawColumns(['actions', 'placeholder', 'responsable']);

            return $table->make(true);
        }

        /*$users = User::getAll();
        $teams = Team::get();*/
        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.indicadoresSgsis.index', compact('organizacion_actual', 'logo_actual', 'empresa_actual'));
    }

    public function create()
    {
        abort_if(Gate::denies('indicadores_sgsi_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $responsables = Empleado::alta()->get();
        $areas = Area::getAll();
        $procesos = Proceso::getAll();

        return view('admin.indicadoresSgsis.create', compact('areas', 'responsables', 'procesos'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('indicadores_sgsi_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            'nombre' => 'required|string',
            'id_area' => 'required',
            'id_empleado' => 'required',
            'id_proceso' => 'required',
            'descripcion' => 'nullable|string',
            'rojo' => 'required|numeric',
            'amarillo' => 'required|numeric',
            'verde' => 'required|numeric',
            'formula' => 'required',
            'frecuencia' => 'required',
            'unidadmedida' => 'required',
            'meta' => 'required',
            'no_revisiones' => 'required',
            'ano' => 'required',
        ]);
        $indicadoresSgsi = IndicadoresSgsi::create($request->all());
        //return redirect()->route('admin.indicadores-sgsis.index');
        return redirect()->route('admin.indicadores-sgsisInsertar', ['id' => $indicadoresSgsi->id])->with('success', 'Guardado con éxito');
    }

    public function edit(IndicadoresSgsi $indicadoresSgsi)
    {
        abort_if(Gate::denies('indicadores_sgsi_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $procesos = Proceso::getAll();
        $responsables = Empleado::alta()->get();
        $areas = Area::getAll();
        if ($indicadoresSgsi->formula_raw == null) {
            $indicadoresSgsi->update(['formula_raw' => $indicadoresSgsi->formula]);
        }

        return view('admin.indicadoresSgsis.edit', compact('areas', 'procesos', 'indicadoresSgsi', 'responsables'));
    }

    public function update(Request $request, IndicadoresSgsi $indicadoresSgsi)
    {
        abort_if(Gate::denies('indicadores_sgsi_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            'nombre' => 'required|string',
            'id_area' => 'required',
            'id_empleado' => 'required',
            'id_proceso' => 'required',
            'descripcion' => 'nullable|string',
            'rojo' => 'required|numeric',
            'amarillo' => 'required|numeric',
            'verde' => 'required|numeric',
            'formula' => 'required',
            'frecuencia' => 'required',
            'unidadmedida' => 'required',
            'meta' => 'required',
            'no_revisiones' => 'required',
            'ano' => 'required',
        ]);
        $indicadoresSgsi->update($request->all());

        //return redirect()->route('admin.indicadores-sgsis.index');
        return redirect()->route('admin.indicadores-sgsisUpdate', ['id' => $indicadoresSgsi->id])->with('success', 'Editado con éxito');
    }

    public function show(IndicadoresSgsi $indicadoresSgsi)
    {
        abort_if(Gate::denies('indicadores_sgsi_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.indicadoresSgsis.show', compact('indicadoresSgsi'));
    }

    public function destroy(IndicadoresSgsi $indicadoresSgsi)
    {
        abort_if(Gate::denies('indicadores_sgsi_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $indicadoresSgsi->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');
    }

    public function massDestroy(MassDestroyIndicadoresSgsiRequest $request)
    {
        IndicadoresSgsi::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function IndicadorInsert(Request $request)
    {
        $id = $request->all();
        $indicadoresSgsis = IndicadoresSgsi::find($id['id']);

        $formula_array = explode('!', $indicadoresSgsis->formula);

        $finish_array = [];

        foreach ($formula_array as $result) {
            if (strstr($result, '$')) {
                array_push($finish_array, $result);
            }
        }
        $remplazo_formula = str_replace('!', '', $indicadoresSgsis->formula);
        if ($remplazo_formula) {
            $up = $indicadoresSgsis
                ->update(['formula' => $remplazo_formula, 'formula_raw' => $indicadoresSgsis->formula]);
        }

        //dd($formula_array, $finish_array, $remplazo_formula, $indicadoresSgsis->id);

        // return redirect()->action('Admin\IndicadoresSgsiController@evaluacionesInsert', ['id' => $indicadoresSgsis->id]);
        return redirect()->action('Admin\IndicadoresSgsiController@evaluacionesUpdate', ['id' => $indicadoresSgsis->id, 'variables' => $finish_array]);
    }

    public function IndicadorUpdate(Request $request)
    {
        $id = $request->all();
        $indicadoresSgsis = IndicadoresSgsi::find($id['id']);

        $formula_array = explode('!', $indicadoresSgsis->formula);

        $finish_array = [];

        foreach ($formula_array as $result) {
            if (strstr($result, '$')) {
                array_push($finish_array, $result);
            }
        }
        // dd($finish_array);
        $remplazo_formula = str_replace('!', '', $indicadoresSgsis->formula);

        if ($remplazo_formula) {
            $up = $indicadoresSgsis
                ->update(['formula' => $remplazo_formula, 'formula_raw' => $indicadoresSgsis->formula]);
        }

        return redirect()->action('Admin\IndicadoresSgsiController@evaluacionesUpdate', ['id' => $indicadoresSgsis->id, 'variables' => $finish_array]);
    }

    public function evaluacionesInsert(Request $request)
    {
        $id = $request->all('id');

        $indicadoresSgsis = IndicadoresSgsi::find($id['id']);

        $variables = $request->all('variables');
        // dd($variables);
        if ($variables['variables'] == null) {

            $indicadoresSgsi = IndicadoresSgsi::find($id['id']);

            if ($indicadoresSgsi->formula_raw == null) {
                $indicadoresSgsi->update(['formula_raw' => $indicadoresSgsi->formula]);
            }

            $formula_r = $indicadoresSgsi->formula_raw;
            $chars = ["$", '/', '*', '-', '+'];
            $onlyconsonants = $formula_r;
            foreach ($chars as $key => $char) {
                $onlyconsonants = str_replace($char, '!' . $char, $onlyconsonants);
            }

            $formula_array = explode('!', $onlyconsonants);

            $finish_array = [];

            foreach ($formula_array as $result) {
                if (strstr($result, '$')) {
                    array_push($finish_array, $result);
                }
            }

            return view('admin.indicadoresSgsis.evaluacion')
                ->with('indicadoresSgsis', $indicadoresSgsis)
                ->with('variables', $finish_array);
        }

        return view('admin.indicadoresSgsis.evaluacion')
            ->with('indicadoresSgsis', $indicadoresSgsis)
            ->with('variables', $variables);
    }

    public function evaluacionesUpdate(Request $request)
    {
        // dd($request->all('id'));
        $id = $request->all('id');
        $variables = $request->all('variables');
        // dd($variables);
        $indicadoresSgsis = IndicadoresSgsi::find($id['id']);

        return view('admin.indicadoresSgsis.evaluacion')->with('indicadoresSgsis', $indicadoresSgsis)
            ->with('variables', $variables);
    }

    public function indicadoresDashboard(Request $request)
    {
        $indicadores = IndicadoresSgsi::with('evaluacion_indicadors')->get();

        $areas = Area::getAll();

        $porcentajeCumplimiento = DashboardIndicadorSG::first();

        return view('admin.indicadoresSgsis.dashboard', compact('porcentajeCumplimiento', 'areas', 'indicadores'));
    }

    public function indicadoresDashboardPorcentaje(Request $request)
    {
        $request->validate([
            'porcentaje' => 'required|numeric|min:0|max:100',
        ], [
            'porcentaje.required' => 'Porcentaje requerido',
            'porcentaje.min' => 'El porcentaje debe ser mayor o igual a 0',
            'porcentaje.max' => 'El porcentaje debe ser menor o igual a 100',

        ]);

        $porcentajeExists = DashboardIndicadorSG::first();
        if (is_null($porcentajeExists)) {
            DashboardIndicadorSG::create([
                'porcentaje_cumplimiento' => $request->porcentaje,
            ]);
        } else {
            DashboardIndicadorSG::first()->update([
                'porcentaje_cumplimiento' => $request->porcentaje,
            ]);

            return response()->json(['estatus' => 200]);
        }
    }
}
