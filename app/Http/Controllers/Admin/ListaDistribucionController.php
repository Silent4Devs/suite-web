<?php

namespace App\Http\Controllers\admin;

use App\Models\ListaDistribucion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Empleado;
use App\Models\ParticipantesListaDistribucion;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;


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
    public function show(ListaDistribucion $listaDistribucion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $lista = ListaDistribucion::with('participantes.empleado')->find($id);

        for ($i = 1; $i <= $lista->niveles; $i++) {
            // dd($i);
            foreach ($lista->participantes as $participante) {
                if ($participante->nivel == $i) {
                    // dd('entra');
                    $participantes_seleccionados['nivel' . $i][] =
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
        return view('admin.listadistribucion.edit', compact('lista', 'participantes_seleccionados', 'empleados'));
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
        // $participantes = ParticipantesListaDistribucion::where('modulo_id', '=', $lista->id)->get();

        $data = [];
        for ($i = 1; $i <= $request->niveles; $i++) {
            // dd("Entra en el for");
            // Assuming you have arrays like $nivel1, $nivel2, ..., $nivel5
            $nivelArrayName = 'nivel' . $i;
            // dd("Entra en el if", $nivelArrayName, isset($nivelArrayName));
            if (isset($nivelArrayName)) { // Check if the array exists in the controller
                // dd($request->$nivelArrayName);
                $data[$i] = $request->$nivelArrayName;
                // $data[$nivelArrayName] = $nivelArrayName; // Collect data for the current nivel
            }
        }
        // dd($data);
        // dd($participantes);
        foreach ($data as $key => $nivel) {
            // dd($key, $nivel);
            $i = 1;
            foreach ($nivel as $participante) {
                // dd($participante);
                $participantes = ParticipantesListaDistribucion::updateOrCreate(
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
