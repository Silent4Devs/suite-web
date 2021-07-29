<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class AnalisisdeRiesgosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            //Esta es el error , activo_id no lo encuentra, hay que modificar la relacion en el modelo de matrizriesgo
            $query = MatrizRiesgo::with([/*'activo_id',*/'controles', 'team'])->select(sprintf('%s.*', (new MatrizRiesgo)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'matriz_riesgo_show';
                $editGate = 'matriz_riesgo_edit';
                $deleteGate = 'matriz_riesgo_delete';
                $crudRoutePart = 'matriz-riesgos';

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
            $table->editColumn('proceso', function ($row) {
                return $row->proceso ? $row->proceso : "";
            });
            /*$table->addColumn('activo_id', function ($row) {
                return $row->tipoactivo ? $row->tipoactivo->tipo : '';
            });*/

            $table->editColumn('responsableproceso', function ($row) {
                return $row->responsableproceso ? $row->responsableproceso : "";
            });
            $table->editColumn('amenaza', function ($row) {
                return $row->amenaza ? $row->amenaza : "";
            });
            $table->editColumn('vulnerabilidad', function ($row) {
                return $row->vulnerabilidad ? $row->vulnerabilidad : "";
            });
            $table->editColumn('descripcionriesgo', function ($row) {
                return $row->descripcionriesgo ? $row->descripcionriesgo : "";
            });
            $table->editColumn('tipo_riesgo', function ($row) {
                return $row->tipo_riesgo ? MatrizRiesgo::TIPO_RIESGO_SELECT[$row->tipo_riesgo] : '';
            });
            $table->editColumn('confidencialidad', function ($row) {
                return $row->confidencialidad ? $row->confidencialidad : "";
            });
            $table->editColumn('integridad', function ($row) {
                return $row->integridad ? $row->integridad : "";
            });
            $table->editColumn('disponibilidad', function ($row) {
                return $row->disponibilidad ? $row->disponibilidad : "";
            });
            $table->editColumn('probabilidad', function ($row) {
                return $row->probabilidad ? MatrizRiesgo::PROBABILIDAD_SELECT[$row->probabilidad] : '';
            });
            $table->editColumn('impacto', function ($row) {
                return $row->impacto ? MatrizRiesgo::IMPACTO_SELECT[$row->impacto] : '';
            });
            $table->editColumn('nivelriesgo', function ($row) {
                return $row->nivelriesgo ? $row->nivelriesgo : "";
            });
            $table->editColumn('riesgototal', function ($row) {
                return $row->riesgototal ? $row->riesgototal : "";
            });
            $table->editColumn('resultadoponderacion', function ($row) {
                return $row->resultadoponderacion ? $row->resultadoponderacion : "";
            });
            $table->editColumn('riesgoresidual', function ($row) {
                return $row->riesgoresidual ? $row->riesgoresidual : "";
            });
            $table->addColumn('controles_numero', function ($row) {
                return $row->controles ? $row->controles->numero : '';
            });

            $table->editColumn('justificacion', function ($row) {
                return $row->justificacion ? $row->justificacion : "";
            });

            $table->rawColumns(['actions', 'placeholder', 'activo_id', 'controles']);

            return $table->make(true);
        }

        $tipoactivos = Tipoactivo::get();
        $controles = Controle::get();
        $teams = Team::get();


        /*$datos = MatrizRiesgo::select('*')
        ->join('activos', 'matriz_riesgos.activo_id', '=', 'activos.id')
        //->join('tipoactivos', 'activos.tipoactivo_id', '=', 'tipoactivos.id')
        ->get();
        dd($datos);*/

        return view('admin.matrizRiesgos.index', compact('tipoactivos', 'tipoactivos', 'controles', 'teams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
