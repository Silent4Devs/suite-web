<?php

namespace App\Http\Controllers\Admin;

use App\Models\Grupo;
use App\Models\Proceso;
use App\Models\Empleado;
use App\Models\Documento;
use Laracasts\Flash\Flash;
use App\Models\Macroproceso;
use Illuminate\Http\Request;
use App\Models\IndicadoresSgsi;
use App\Models\RevisionDocumento;
use Illuminate\Support\Facades\DB;
use App\Models\EvaluacionIndicador;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Models\HistorialVersionesDocumento;

class ProcesoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Proceso::get();
            $table = DataTables::of($query);

            $table->addColumn('actions', '&nbsp;');
            $table->addIndexColumn();
            $table->editColumn('actions', function ($row) {
                $viewGate      = 'recurso_show';
                $editGate      = 'recurso_edit';
                $deleteGate    = 'recurso_delete';
                $crudRoutePart = 'procesos';

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
            $table->editColumn('codigo', function ($row) {
                return $row->codigo ? $row->codigo : "";
            });
            $table->editColumn('nombre', function ($row) {
                return $row->nombre ? $row->nombre : "";
            });
            $table->editColumn('macroproceso', function ($row) {
                return $row->macroproceso->nombre ? $row->macroproceso->nombre : "";
            });
            $table->editColumn('descripcion', function ($row) {
                return $row->descripcion ? $row->descripcion : "";
            });

            // $table->rawColumns(['actions']);

            return $table->make(true);
        }

        return view('admin.procesos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $macroproceso = DB::table('macroprocesos')->select('id', 'codigo', 'nombre')->get();
        //dd("teasdas". $organizaciones);

        return view('admin.procesos.create')->with('macroprocesos', $macroproceso);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'codigo' => 'required|string',
                'nombre' => 'required|string',
                'id_macroproceso' => 'required|integer',
                'descripcion' => 'required|string'
            ],
        );
        $procesos = proceso::create($request->all());
        Flash::success('<h5 class="text-center">Proceso agregado satisfactoriamente</h5>');
        return redirect()->route('admin.procesos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Proceso  $proceso
     * @return \Illuminate\Http\Response
     */
    public function show(Proceso $proceso)
    {
        return view('admin.procesos.show', compact('proceso'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Proceso  $proceso
     * @return \Illuminate\Http\Response
     */
    public function edit(Proceso $proceso)
    {
        $macroproceso = DB::table('macroprocesos')->select('id', 'codigo', 'nombre')->get();

        return view('admin.procesos.edit', compact('proceso'))->with('macroprocesos', $macroproceso);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Proceso  $proceso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proceso $proceso)
    {
        $request->validate(
            [
                'codigo' => 'required|string',
                'nombre' => 'required|string',
                'id_macroproceso' => 'required|integer',
                'descripcion' => 'required|string'
            ],
        );
        $proceso->update($request->all());
        Flash::success('<h5 class="text-center">Proceso actualizado satisfactoriamente</h5>');
        return redirect()->route('admin.procesos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Proceso  $proceso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proceso $proceso)
    {
        $proceso->delete();
        Flash::success('<h5 class="text-center">Proceso eliminado satisfactoriamente</h5>');
        return redirect()->route('admin.procesos.index');
    }

    public function mapaProcesos()
    {

        $grupos_mapa = Grupo::with(['macroprocesos' => function ($q) {
            $q->with('procesosWithDocumento');
        }])->get();
        // dd($grupos_mapa);
        $macros_mapa = Macroproceso::get();
        $procesos_mapa = Proceso::get();
        $exist_no_publicado = Proceso::select('estatus')->where('estatus', Proceso::NO_ACTIVO)->exists();



        return view('admin.procesos.mapa_procesos', compact('grupos_mapa', 'macros_mapa', 'procesos_mapa', 'exist_no_publicado'));
    }

    public function obtenerDocumentoProcesos($documento)
    {
        $documento = Documento::with('elaborador', 'revisor', 'aprobador', 'responsable', 'macroproceso')->find($documento);
        // dd($documento->elaborador->avatar);
        $proceso = Proceso::where('documento_id', $documento->id)->first();
        $documentos_relacionados = Documento::with('elaborador', 'revisor', 'aprobador', 'responsable', 'macroproceso')->where('proceso_id', $proceso->id)->get();
        $revisiones = RevisionDocumento::with('documento', 'empleado')->where('documento_id', $documento)->get();
        $versiones = HistorialVersionesDocumento::with('revisor', 'elaborador', 'aprobador', 'responsable')->where('documento_id', $documento->id)->get();
        $indicadores = IndicadoresSgsi::get();
        // dd($indicadores::getResultado());

        return view('admin.procesos.vistas', compact('documento', 'revisiones', 'documentos_relacionados', 'versiones', 'indicadores'));
    }

    public function AjaxRequestIndicador(Request $request)
    {
        $input = $request->all();

        $unidad = IndicadoresSgsi::select('unidadmedida')->where('id', $input['id'])->first();

        $res = '<div id="resultado" width="900" height="750"></div>';

        return response()->json(["gauge" => $res, 'datos' => $input, 'unidad' => $unidad], 200);
    }
}
