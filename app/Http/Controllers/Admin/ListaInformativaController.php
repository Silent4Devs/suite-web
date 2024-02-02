<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Empleado;
use App\Models\ListaInformativa;
use App\Models\ParticipantesListaInformativa;
use Illuminate\Http\Request;

class ListaInformativaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = ListaInformativa::with('participantes.empleado')->orderByDesc('id')->get();
        // dd($query);

        $participantes = ListaInformativa::with('participantes.empleado')->get();

        return view('admin.listainformativa.index', compact('query', 'participantes'));
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
        $lista = ListaInformativa::with('participantes.empleado')->find($id);

        $participantes_seleccionados = [];

        foreach ($lista->participantes as $participante) {

            $participantes_seleccionados[] =
                [
                    'empleado_id' => $participante->empleado_id,
                ];
        }

        $empleados = Empleado::getAltaDataColumns();

        return view('admin.listainformativa.show', compact('lista', 'participantes_seleccionados', 'empleados'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $lista = ListaInformativa::with('participantes.empleado')->find($id);

        $participantes_seleccionados = [];

        foreach ($lista->participantes as $participante) {

            $participantes_seleccionados[] =
                [
                    'empleado_id' => $participante->empleado_id,
                ];
        }

        $empleados = Empleado::getAltaDataColumns();

        return view('admin.listainformativa.edit', compact('lista', 'participantes_seleccionados', 'empleados'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $lista = ListaInformativa::select('id')->find($id);
        // dd($id, $request->all());

        if (isset($request->nivel1[0])) {
            $participantes = ParticipantesListaInformativa::where('modulo_id', '=', $lista->id)->delete();

            $data = $request->nivel1;

            foreach ($data as $participante) {
                $participantes = ParticipantesListaInformativa::create(
                    [
                        'modulo_id' => $lista->id,
                        'empleado_id' => $participante,
                    ],
                );
            }
        } else {
            // dd('No existe', $nom_niv);
            $errorMessage = 'La lista informativa debe contener al menos un colaborador.';

            // Manually add error message to $errors bag
            $errors = new \Illuminate\Support\MessageBag();
            $errors->add('nivel_null', $errorMessage);

            // Redirect back with the input data and errors
            return redirect()->back()->withErrors($errors)->withInput();
        }

        return redirect(route('admin.lista-distribucion.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ListaInformativa $listainformativa)
    {
        //
    }
}
