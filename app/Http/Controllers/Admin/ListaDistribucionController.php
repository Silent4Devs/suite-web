<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Empleado;
use App\Models\ListaDistribucion;
use App\Models\ParticipantesListaDistribucion;
use Illuminate\Http\Request;

class ListaDistribucionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {

            $query = ListaDistribucion::with('participantes.empleado')->orderByDesc('id')->get();
            $table = datatables()::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'incidentes_vacaciones_crear';
                $editGate = 'incidentes_vacaciones_editar';
                $deleteGate = 'incidentes_vacaciones_eliminar';
                $crudRoutePart = 'incidentes-vacaciones';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('modulo', function ($row) {
                return $row->modulo ? $row->modulo : '';
            });
            $table->editColumn('submodulo', function ($row) {
                return $row->submodulo ? $row->submodulo : '';
            });
            $table->editColumn('participantes', function ($row) {
                return $row->participantes ? $row->participantes : '';
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $data['participantes'] = ListaDistribucion::with('participantes.empleado')->get();

        return view('admin.listadistribucion.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $lista = ListaDistribucion::with('participantes.empleado')->find($id);

        $superaprobadores_seleccionados = [];
        // dd($i);
        foreach ($lista->participantes as $participante) {
            if ($participante->nivel == 0) {
                // dd('entra');
                $superaprobadores_seleccionados[] =
                    [
                        'empleado_id' => $participante->empleado_id,
                        'numero_orden' => $participante->numero_orden,
                    ];
            }
        }
        // dd($superaprobadores_seleccionados);
        for ($i = 1; $i <= $lista->niveles; $i++) {
            // dd($i);
            foreach ($lista->participantes as $participante) {
                if ($participante->nivel == $i) {
                    // dd('entra');
                    $participantes_seleccionados['nivel'.$i][] =
                        [
                            'empleado_id' => $participante->empleado_id,
                            'numero_orden' => $participante->numero_orden,
                        ];
                }
            }
        }
        // dd($participantes_seleccionados);
        // $participantes = $lista->participantes;

        // $participantes_seleccionados[] = $lista->participantes->pluck('empleado_id', 'nivel', 'numero_orden')->toArray();

        // $areas_seleccionadas = $vacacion->areas->pluck('id')->toArray();
        // dd($participantes_seleccionados);
        $empleados = Empleado::getAltaDataColumns();

        // dd($lista->participantes);
        // dd('Llega', $id, $lista_distribucion);
        // dd($empleados);
        return view('admin.listadistribucion.show', compact('lista', 'superaprobadores_seleccionados', 'participantes_seleccionados', 'empleados'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $lista = ListaDistribucion::with('participantes.empleado')->find($id);

        $superaprobadores_seleccionados = [];

        foreach ($lista->participantes as $participante) {
            if ($participante->nivel == 0) {
                // dd('entra');
                $superaprobadores_seleccionados[] =
                    [
                        'empleado_id' => $participante->empleado_id,
                        'numero_orden' => $participante->numero_orden,
                    ];
            }
        }

        $participantes_seleccionados = [];

        for ($i = 1; $i <= $lista->niveles; $i++) {

            foreach ($lista->participantes as $participante) {
                if ($participante->nivel == $i) {

                    $participantes_seleccionados['nivel'.$i][] =
                        [
                            'empleado_id' => $participante->empleado_id,
                            'numero_orden' => $participante->numero_orden,
                        ];
                }
            }
        }

        $empleados = Empleado::getAltaDataColumns();

        return view('admin.listadistribucion.edit', compact('lista', 'superaprobadores_seleccionados', 'participantes_seleccionados', 'empleados'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        // dd($id);
        // dd($request->niveles, $request->all());
        $lista = ListaDistribucion::select('id')->find($id);
        // dd($lista_id);
        //Se borran los participantes anteiores
        $participantes = ParticipantesListaDistribucion::where('modulo_id', '=', $lista->id)->delete();

        // dd($request->all());

        $lista->update([
            'niveles' => $request->niveles,
        ]);

        $data = [];
        for ($i = 1; $i <= $request->niveles; $i++) {
            $nivelArrayName = 'nivel'.$i;
            if (isset($nivelArrayName)) {
                $data[$i] = $request->$nivelArrayName;
                // $data[$nivelArrayName] = $nivelArrayName;
            }
        }

        if (isset($request->superaprobadores)) {
            $superi = 1;
            foreach ($request->superaprobadores as $superaprobador) {
                // dd("superaprobador", $superaprobador);
                $super = ParticipantesListaDistribucion::create(
                    [
                        'modulo_id' => $lista->id,
                        'nivel' => 0,
                        'numero_orden' => $superi,
                        'empleado_id' => $superaprobador,
                    ],
                );
                $i++;
            }
        }

        foreach ($data as $key => $nivel) {
            $i = 1;
            foreach ($nivel as $participante) {

                $participantes = ParticipantesListaDistribucion::create(
                    [
                        'modulo_id' => $lista->id,
                        'nivel' => $key,
                        'numero_orden' => $i,
                        'empleado_id' => $participante,
                    ],
                );
                $i++;
            }
        }

        return redirect(route('admin.lista-distribucion.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ListaDistribucion $listaDistribucion)
    {
        //
    }
}
