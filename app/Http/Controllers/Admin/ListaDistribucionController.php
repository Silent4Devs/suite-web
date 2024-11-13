<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContractManager\Comprador;
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

        if ($lista->modelo == 'Comprador') {
            // Sincronizar compradores y participantes
            $this->syncCompradores($lista);
            $lista = ListaDistribucion::with('participantes.empleado')->find($id);
        } elseif ($lista->modelo == 'Empleado') {
            // Sincronizar lideres y participantes
            $this->syncLideres($lista);
            $lista = ListaDistribucion::with('participantes.empleado')->find($id);
        }

        $empleados = Empleado::getAltaDataColumns();
        $tipo = $this->determineTipo($lista->modelo);

        $superaprobadores_seleccionados = $this->getSuperAprobadores($lista->participantes);
        $participantes_seleccionados = $this->getParticipantesSeleccionados($lista);

        // dd($participantes_seleccionados["nivel1"]);
        return view('admin.listadistribucion.edit', compact('lista', 'superaprobadores_seleccionados', 'participantes_seleccionados', 'empleados', 'tipo'));
    }

    private function determineTipo($modelo)
    {
        return match ($modelo) {
            'KatbolRequsicion', 'OrdenCompra' => 'suplentes',
            'Empleado' => 'responsablesFijos',
            'Comprador' => 'responsablesFijos',
            default => 'flujoAprobacion',
        };
    }

    private function getSuperAprobadores($participantes)
    {
        return $participantes->filter(fn ($p) => $p->nivel == 0)
            ->map(fn ($p) => [
                'empleado_id' => $p->empleado_id,
                'numero_orden' => $p->numero_orden,
            ])->values()->toArray();
    }

    private function getParticipantesSeleccionados($lista)
    {
        $participantes_seleccionados = [];
        for ($i = 1; $i <= $lista->niveles; $i++) {
            $participantes_seleccionados['nivel'.$i] = $lista->participantes
                ->filter(fn ($p) => $p->nivel == $i)
                ->map(fn ($p) => [
                    'empleado_id' => $p->empleado_id,
                    'numero_orden' => $p->numero_orden,
                ])->values()->toArray();
        }

        return $participantes_seleccionados;
    }

    public function syncLideres($lista)
    {
        // Obtener los supervisores actuales del modelo 'Empleado'
        $supervisores = Empleado::listaSupervisores();
        $count_supervisores = $supervisores->count();

        // Filtrar los participantes existentes cuyo numero_orden sea 1
        $participantes = $lista->participantes->where('numero_orden', 1);

        // Convertir las colecciones a arrays de IDs para facilidad de comparación
        $supervisorIds = $supervisores->toArray();
        $participanteIds = $participantes->pluck('empleado_id')->toArray();

        // Crear registros en participantes si existen en supervisores pero no en participantes
        $idsParaAgregar = array_diff($supervisorIds, $participanteIds);

        // Agregar nuevos participantes con un nivel temporal (0) para no interferir con los existentes
        foreach ($idsParaAgregar as $id) {
            ParticipantesListaDistribucion::create([
                'modulo_id' => $lista->id,
                'nivel' => 0, // Nivel temporal
                'numero_orden' => 1,
                'empleado_id' => $id,
            ]);
        }

        // Eliminar registros en participantes si existen en participantes pero no en supervisores
        $idsParaEliminar = array_diff($participanteIds, $supervisorIds);
        ParticipantesListaDistribucion::whereIn('empleado_id', $idsParaEliminar)
            ->where('modulo_id', $lista->id)
            ->delete();

        // Ahora reasignamos los niveles desde 1 en adelante para asegurar la secuencia
        $participantesOrdenados = ParticipantesListaDistribucion::where('modulo_id', $lista->id)
            ->where('numero_orden', 1)
            ->orderBy('id')
            ->get();

        $nuevoNivel = 1;
        foreach ($participantesOrdenados as $participante) {
            $participante->update(['nivel' => $nuevoNivel]);
            $nuevoNivel++;
        }

        // Actualizar el valor de 'niveles' en la lista con el nuevo nivel máximo
        $lista->update(['niveles' => $nuevoNivel - 1]);
    }

    public function syncCompradores($lista)
    {
        // Obtener los compradores actuales del modelo 'Comprador'
        $compradores = Comprador::getArchivoFalse();
        $count_compradores = $compradores->count();

        // Filtrar los participantes existentes cuyo numero_orden sea 1
        $participantes = $lista->participantes->where('numero_orden', 1);

        // Convertir las colecciones a arrays de IDs para facilidad de comparación
        $compradorIds = $compradores->pluck('id_user')->toArray();
        $participanteIds = $participantes->pluck('empleado_id')->toArray();

        // Crear registros en participantes si existen en compradores pero no en participantes
        $idsParaAgregar = array_diff($compradorIds, $participanteIds);

        // Agregar nuevos participantes con un nivel temporal (0) para no interferir con los existentes
        foreach ($idsParaAgregar as $id) {
            ParticipantesListaDistribucion::create([
                'modulo_id' => $lista->id,
                'nivel' => 0, // Nivel temporal
                'numero_orden' => 1,
                'empleado_id' => $id,
            ]);
        }

        // Eliminar registros en participantes si existen en participantes pero no en compradores
        $idsParaEliminar = array_diff($participanteIds, $compradorIds);
        ParticipantesListaDistribucion::whereIn('empleado_id', $idsParaEliminar)
            ->where('modulo_id', $lista->id)
            ->delete();

        // Ahora reasignamos los niveles desde 1 en adelante para asegurar la secuencia
        $participantesOrdenados = ParticipantesListaDistribucion::where('modulo_id', $lista->id)
            ->where('numero_orden', 1)
            ->orderBy('id')
            ->get();

        $nuevoNivel = 1;
        foreach ($participantesOrdenados as $participante) {
            $participante->update(['nivel' => $nuevoNivel]);
            $nuevoNivel++;
        }

        // Actualizar el valor de 'niveles' en la lista con el nuevo nivel máximo
        $lista->update(['niveles' => $nuevoNivel - 1]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('lista_distribucion_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        //
        $lista = ListaDistribucion::with('participantes.empleado')->find($id);

        // Sincronizar compradores y participantes
        $val_niv = $request->niveles;
        $nom_niv = 'nivel'.$val_niv;

        if (isset($request->$nom_niv) && ($lista->modelo != 'Comprador') && ($lista->modelo != 'Empleado')) {
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
        } elseif ($lista->modelo == 'Comprador' || $lista->modelo == 'Empleado') {
            $participantes = ParticipantesListaDistribucion::where('modulo_id', '=', $lista->id)->whereNot('numero_orden', 1)->delete();
            $lista = ListaDistribucion::with('participantes.empleado')->find($id);

            if ($lista->modelo == 'Comprador') {
                // code...
                $this->syncCompradores($lista);
            } elseif ($lista->modelo == 'Empleado') {
                $this->syncLideres($lista);
            }

            $lista = ListaDistribucion::with('participantes.empleado')->find($id);

            $data = [];
            for ($i = 1; $i <= $request->niveles; $i++) {
                $nivelArrayName = 'nivel'.$i;
                if (isset($nivelArrayName)) {
                    $data[$i] = $request->$nivelArrayName;
                    // $data[$nivelArrayName] = $nivelArrayName;
                }
            }

            foreach ($data as $key => $nivel) {
                // dd($key, $nivel);
                $i = 2;
                if (! empty($nivel)) {
                    foreach ($nivel as $participante) {
                        $participantes = ParticipantesListaDistribucion::updateOrCreate(
                            [
                                'modulo_id' => $lista->id,
                                'empleado_id' => $participante,
                                'nivel' => $key,
                            ],
                            [
                                'numero_orden' => $i,
                            ],
                        );
                        $i++;
                    }
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
