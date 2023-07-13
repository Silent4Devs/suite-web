<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyIndicadoresSgsiRequest;
use App\Models\Empleado;
use App\Models\IndicadoresSgsi;
use App\Models\Proceso;
use App\Models\Team;
use App\Models\User;
use App\Models\VariablesIndicador;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class IndicadoresSgsiController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('indicadores_sgsi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = IndicadoresSgsi::orderByDesc('id')->get();
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'indicadores_sgsi_show';
                $editGate = 'indicadores_sgsi_edit';
                $deleteGate = 'indicadores_sgsi_delete';
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

        return view('admin.indicadoresSgsis.index');
    }

    public function create()
    {
        abort_if(Gate::denies('indicadores_sgsi_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $responsables = Empleado::getAll();
        $procesos = Proceso::getAll();

        return view('admin.indicadoresSgsis.create', compact('responsables', 'procesos'));
    }

    public function store(Request $request)
    {
        $indicadoresSgsi = IndicadoresSgsi::create($request->all());
        //return redirect()->route('admin.indicadores-sgsis.index');
        return redirect()->route('admin.indicadores-sgsisInsertar', ['id' => $indicadoresSgsi->id])->with('success', 'Guardado con éxito');
    }

    public function edit(IndicadoresSgsi $indicadoresSgsi)
    {
        $procesos = Proceso::getAll();
        $responsables = Empleado::getAll();

        return view('admin.indicadoresSgsis.edit', compact('procesos', 'indicadoresSgsi', 'responsables'));
    }

    public function update(Request $request, IndicadoresSgsi $indicadoresSgsi)
    {
        $indicadoresSgsi->update($request->all());

        //return redirect()->route('admin.indicadores-sgsis.index');
        return redirect()->route('admin.indicadores-sgsisUpdate', ['id' => $indicadoresSgsi->id])->with('success', 'Editado con éxito');
    }

    public function show(IndicadoresSgsi $indicadoresSgsi)
    {
        return view('admin.indicadoresSgsis.show', compact('indicadoresSgsi'));
    }

    public function destroy(IndicadoresSgsi $indicadoresSgsi)
    {
        abort_if(Gate::denies('indicadores_sgsi_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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
                ->update(['formula' => $remplazo_formula]);
        }

        foreach ($finish_array as $key => $value) {
            VariablesIndicador::create(['id_indicador' => $indicadoresSgsis->id, 'variable' => str_replace('.', '', $value)]);
        }

        //dd($formula_array, $finish_array, $remplazo_formula, $indicadoresSgsis->id);

        return redirect()->action('Admin\IndicadoresSgsiController@evaluacionesInsert', ['id' => $indicadoresSgsis->id]);
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

        $remplazo_formula = str_replace('!', '', $indicadoresSgsis->formula);

        if ($remplazo_formula) {
            $up = $indicadoresSgsis
                ->update(['formula' => $remplazo_formula]);
        }

        $variablesIndicadores = VariablesIndicador::where('id_indicador', $indicadoresSgsis->id)->get();

        /*foreach ($finish_array as $key => $value) {

            VariablesIndicador::create([
                'id_indicador' => $indicadoresSgsis->id,
                'variable' => str_replace(".", "", $value),
            ]);
        }*/

        return redirect()->action('Admin\IndicadoresSgsiController@evaluacionesUpdate', ['id' => $indicadoresSgsis->id]);
    }

    public function evaluacionesInsert(Request $request)
    {
        $id = $request->all();

        $indicadoresSgsis = IndicadoresSgsi::find($id['id']);

        return view('admin.indicadoresSgsis.evaluacion')
            ->with('indicadoresSgsis', $indicadoresSgsis);
    }

    public function evaluacionesUpdate(Request $request)
    {
        $id = $request->all();

        $indicadoresSgsis = IndicadoresSgsi::find($id['id']);

        return view('admin.indicadoresSgsis.evaluacion')
            ->with('indicadoresSgsis', $indicadoresSgsis);
    }
}
