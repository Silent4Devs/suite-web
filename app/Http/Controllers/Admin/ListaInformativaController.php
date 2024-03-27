<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Empleado;
use App\Models\ListaInformativa;
use App\Models\ParticipantesListaInformativa;
use App\Models\User;
use App\Models\UsuariosListaInformativa;
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

        $usuarios = ListaInformativa::with('usuarios.usuario')->get();

        return view('admin.listainformativa.index', compact('query', 'participantes', 'usuarios'));
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
        $lista = ListaInformativa::with('participantes.empleado', 'usuarios.usuario')->find($id);

        $participantes_seleccionados = [];

        $usuarios_seleccionados = [];

        foreach ($lista->participantes as $participante) {

            $participantes_seleccionados['nivel1'][] =
                [
                    'empleado_id' => $participante->empleado_id,
                ];
        }

        foreach ($lista->usuarios as $usuario) {

            $participantes_seleccionados['nivel2'][] =
                [
                    'empleado_id' => $usuario->usuario_id,
                ];
        }
        // dd($participantes_seleccionados);
        $empleados = Empleado::getAltaDataColumns();

        $usuarios = User::getAllWithEmpleado()
            ->filter(function ($user) {
                return $user->empleado == null;
            });

        // dd($usuarios);
        return view('admin.listainformativa.show', compact('lista', 'participantes_seleccionados', 'empleados', 'usuarios'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $lista = ListaInformativa::with('participantes.empleado', 'usuarios.usuario')->find($id);

        $participantes_seleccionados = [];

        $usuarios_seleccionados = [];

        foreach ($lista->participantes as $participante) {

            $participantes_seleccionados['nivel1'][] =
                [
                    'empleado_id' => $participante->empleado_id,
                ];
        }

        foreach ($lista->usuarios as $usuario) {

            $participantes_seleccionados['nivel2'][] =
                [
                    'empleado_id' => $usuario->usuario_id,
                ];
        }
        // dd($participantes_seleccionados);
        $empleados = Empleado::getAltaDataColumns();

        $usuarios = User::getAllWithEmpleado()
            ->filter(function ($user) {
                return $user->empleado == null;
            });

        // dd($usuarios);
        return view('admin.listainformativa.edit', compact('lista', 'participantes_seleccionados', 'empleados', 'usuarios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $lista = ListaInformativa::select('id')->find($id);

        if (isset($request->nivel1[0]) || isset($request->nivel2[0])) {
            $participantes = ParticipantesListaInformativa::where('modulo_id', '=', $lista->id)->delete();
            $usuarios = UsuariosListaInformativa::where('modulo_id', '=', $lista->id)->delete();

            if (isset($request->nivel1[0])) {
                $data1 = $request->nivel1;

                foreach ($data1 as $participante) {
                    $participantes = ParticipantesListaInformativa::create(
                        [
                            'modulo_id' => $lista->id,
                            'empleado_id' => $participante,
                        ],
                    );
                }
            }

            if (isset($request->nivel2[0])) {
                $data2 = $request->nivel2;

                foreach ($data2 as $participante) {
                    $participantes = UsuariosListaInformativa::create(
                        [
                            'modulo_id' => $lista->id,
                            'usuario_id' => $participante,
                        ],
                    );
                }
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

        return redirect(route('admin.lista-informativa.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ListaInformativa $listainformativa)
    {
        //
    }
}
