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

        // if ($request->ajax()) {

        //     $query = ListaInformativa::with('participantes.empleado')->orderByDesc('id')->get();
        //     $table = datatables()::of($query);

        //     $table->addColumn('placeholder', '&nbsp;');
        //     $table->addColumn('actions', '&nbsp;');

        //     $table->editColumn('actions', function ($row) {
        //         $viewGate = 'incidentes_vacaciones_crear';
        //         $editGate = 'incidentes_vacaciones_editar';
        //         $deleteGate = 'incidentes_vacaciones_eliminar';
        //         $crudRoutePart = 'incidentes-vacaciones';

        //         return view('partials.datatablesActions', compact(
        //             'viewGate',
        //             'editGate',
        //             'deleteGate',
        //             'crudRoutePart',
        //             'row'
        //         ));
        //     });

        //     $table->editColumn('modulo', function ($row) {
        //         return $row->modulo ? $row->modulo : '';
        //     });
        //     $table->editColumn('submodulo', function ($row) {
        //         return $row->submodulo ? $row->submodulo : '';
        //     });
        //     $table->editColumn('participantes', function ($row) {
        //         return $row->participantes ? $row->participantes : '';
        //     });

        //     $table->editColumn('id', function ($row) {
        //         return $row->id ? $row->id : '';
        //     });

        //     $table->rawColumns(['actions', 'placeholder']);

        //     return $table->make(true);
        // }

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

        for ($i = 1; $i <= $lista->niveles; $i++) {

            foreach ($lista->participantes as $participante) {
                if ($participante->nivel == $i) {

                    $participantes_seleccionados['nivel' . $i][] =
                        [
                            'empleado_id' => $participante->empleado_id,
                        ];
                }
            }
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
        // dd($id);
        // dd($request->niveles, $request->all());
        $lista = ListaInformativa::select('id')->find($id);
        // dd($lista_id);
        // dd($request->all());
        $val_niv = $request->niveles;
        $nom_niv = 'nivel' . $val_niv;

        if (isset($request->$nom_niv)) {
            $participantes = ParticipantesListaInformativa::where('modulo_id', '=', $lista->id)->delete();

            $data = [];
            for ($i = 1; $i <= $request->niveles; $i++) {
                $nivelArrayName = 'nivel' . $i;
                if (isset($nivelArrayName)) {
                    $data[$i] = $request->$nivelArrayName;
                    // $data[$nivelArrayName] = $nivelArrayName;
                }
            }

            if (isset($request->superaprobadores)) {
                $superi = 1;
                foreach ($request->superaprobadores as $superaprobador) {
                    // dd("superaprobador", $superaprobador);
                    $super = ParticipantesListaInformativa::create(
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

                    $participantes = ParticipantesListaInformativa::create(
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
