<?php

namespace App\Http\Controllers\Admin;

use Gate;
use App\Models\Team;
use App\Models\User;
use App\Models\Proceso;
use App\Models\Empleado;
use Illuminate\Http\Request;
use App\Models\IndicadoresSgsi;
use App\Models\VariablesIndicador;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\StoreIndicadoresSgsiRequest;
use App\Http\Requests\UpdateIndicadoresSgsiRequest;
use App\Http\Requests\MassDestroyIndicadoresSgsiRequest;

class IndicadoresSgsiController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('indicadores_sgsi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = IndicadoresSgsi::get();
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'indicadores_sgsi_show';
                $editGate      = 'indicadores_sgsi_edit';
                $deleteGate    = 'indicadores_sgsi_delete';
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
                return $row->id ? $row->id : "";
            });

            $table->editColumn('nombre', function ($row) {
                return $row->nombre ? $row->nombre : "";
            });

            $table->editColumn('proceso', function ($row) {
                return $row->proceso->nombre ? $row->proceso->nombre : "";
            });

            $table->editColumn('descripcion', function ($row) {
                return $row->descripcion ? $row->descripcion : "";
            });

            $table->editColumn('formula', function ($row) {
                return $row->formula ? $row->formula : "";
            });

            $table->editColumn('unidadmedida', function ($row) {
                return $row->unidadmedida ? $row->unidadmedida : "";
            });

            $table->editColumn('frecuencia', function ($row) {
                return $row->formula ? $row->formula : "";
            });

            $table->editColumn('meta', function ($row) {
                return $row->meta ? $row->meta : "";
            });

            $table->editColumn('revisiones', function ($row) {
                return $row->no_revisiones ? $row->no_revisiones : "";
            });

            $table->editColumn('resultado', function ($row) {
                return $row->resultado ? $row->resultado : "";
            });

            $table->editColumn('responsable', function ($row) {
                return $row->id_empleado ? $row->id_empleado : "";
            });

            $table->rawColumns(['actions', 'placeholder', 'responsable']);

            return $table->make(true);
        }

        $users = User::get();
        $teams = Team::get();

        return view('admin.indicadoresSgsis.index', compact('users', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('indicadores_sgsi_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $responsables = Empleado::get();
        $procesos = Proceso::get();

        return view('admin.indicadoresSgsis.create', compact('responsables', 'procesos'));
    }

    public function store(Request $request)
    {
        $indicadoresSgsi = IndicadoresSgsi::create($request->all());
        //return redirect()->route('admin.indicadores-sgsis.index');
        return redirect()->route('admin.indicadores-sgsisInsertar', ['id' => $indicadoresSgsi->id]);
    }

    public function edit(IndicadoresSgsi $indicadoresSgsi)
    {
        abort_if(Gate::denies('indicadores_sgsi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $responsables = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $indicadoresSgsi->load('responsable', 'team');

        return view('admin.indicadoresSgsis.edit', compact('responsables', 'indicadoresSgsi'));
    }

    public function update(UpdateIndicadoresSgsiRequest $request, IndicadoresSgsi $indicadoresSgsi)
    {
        $indicadoresSgsi->update($request->all());

        return redirect()->route('admin.indicadores-sgsis.index');
    }

    public function show(IndicadoresSgsi $indicadoresSgsi)
    {
        abort_if(Gate::denies('indicadores_sgsi_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');



        return view('admin.indicadoresSgsis.show', compact('indicadoresSgsi'));
    }

    public function destroy(IndicadoresSgsi $indicadoresSgsi)
    {
        abort_if(Gate::denies('indicadores_sgsi_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $indicadoresSgsi->delete();

        return back();
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

        $formula_array = explode("!", $indicadoresSgsis->formula);

        $finish_array = array();

        foreach ($formula_array as $result) {
            if (strstr($result, '$')) {
                array_push($finish_array, $result);
            }
        };

        $remplazo_formula = str_replace("!", "", $indicadoresSgsis->formula);

        if ($remplazo_formula) {
            $up = $indicadoresSgsis
                ->update(['formula' => $remplazo_formula]);
        }

        foreach ($finish_array as $key => $value) {

            VariablesIndicador::create(['id_indicador' => $indicadoresSgsis->id, 'variable' => str_replace(".", "", $value)]);
        }

        //dd($formula_array, $finish_array, $remplazo_formula, $indicadoresSgsis->id);

        return redirect()->action('Admin\IndicadoresSgsiController@evaluacionesInsert', ['id' => $indicadoresSgsis->id]);

    }

    public function evaluacionesInsert(Request $request)
    {
        $id = $request->all();

        $indicadoresSgsis = IndicadoresSgsi::find($id['id']);

        return view('admin.indicadoresSgsis.evaluacion')
            ->with('indicadoresSgsis', $indicadoresSgsis);
    }
}
