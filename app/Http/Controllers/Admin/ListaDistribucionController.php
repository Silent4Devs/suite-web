<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Empleado;
use App\Models\ListaDistribucion;
use App\Models\ParticipantesListaDistribucion;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ListaDistribucionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies('lista_distribucion_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $query = ListaDistribucion::getAll();

        $participantes = ListaDistribucion::with('participantes.empleado')->get();

        return view('admin.listadistribucion.index', compact('query', 'participantes'));
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
        abort_if(Gate::denies('lista_distribucion_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lista = ListaDistribucion::with('participantes.empleado')->find($id);

        $superaprobadores_seleccionados = [];

        foreach ($lista->participantes as $participante) {
            if ($participante->nivel == 0) {
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

        return view('admin.listadistribucion.show', compact('lista', 'superaprobadores_seleccionados', 'participantes_seleccionados', 'empleados'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        abort_if(Gate::denies('lista_distribucion_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lista = ListaDistribucion::with('participantes.empleado')->find($id);
        $empleados = Empleado::getAltaDataColumns();

        $tipo = 'flujo';

        $superaprobadores_seleccionados = [];

        foreach ($lista->participantes as $participante) {
            if ($participante->nivel == 0) {
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

        if ($lista->modelo == 'KatbolRequsicion' || $lista->modelo == 'OrdenCompra') {
            $tipo = 'suplentes';
        } elseif ($lista->modelo == 'Empleado') {
            $tipo = 'suplentesLideres';
        } else {
            $tipo = 'flujoAprobacion';
        }

        return view('admin.listadistribucion.edit', compact('lista', 'superaprobadores_seleccionados', 'participantes_seleccionados', 'empleados', 'tipo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('lista_distribucion_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        //
        $lista = ListaDistribucion::select('id')->find($id);

        $val_niv = $request->niveles;
        $nom_niv = 'nivel'.$val_niv;

        if (isset($request->$nom_niv)) {
            $participantes = ParticipantesListaDistribucion::where('modulo_id', '=', $lista->id)->delete();
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
                    $superi++;
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
        } else {
            // dd('No existe', $nom_niv);
            $errorMessage = 'No puede haber niveles sin colaboradores asignados';

            // Manually add error message to $errors bag
            $errors = new \Illuminate\Support\MessageBag;
            $errors->add('nivel_null', $errorMessage);

            // Redirect back with the input data and errors
            return redirect()->back()->withErrors($errors)->withInput();
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
