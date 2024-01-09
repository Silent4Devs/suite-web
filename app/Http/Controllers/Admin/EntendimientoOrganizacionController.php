<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyEntendimientoOrganizacionRequest;
use App\Mail\NotificacionRechazoAnalisisFODA;
use App\Mail\NotificacionRechazoAnalisisFODALider;
use App\Mail\NotificacionSolicitudAprobacionAnalisisFODA;
use App\Models\AmenazasEntendimientoOrganizacion;
use App\Models\ComentariosProcesosListaDistribucion;
use App\Models\ControlListaDistribucion;
use App\Models\DebilidadesEntendimientoOrganizacion;
use App\Models\Empleado;
use App\Models\EntendimientoOrganizacion;
use App\Models\FortalezasEntendimientoOrganizacion;
use App\Models\ListaDistribucion;
use App\Models\OportunidadesEntendimientoOrganizacion;
use App\Models\ProcesosListaDistribucion;
use App\Models\Team;
use App\Models\User;
use App\Traits\ObtenerOrganizacion;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class EntendimientoOrganizacionController extends Controller
{
    use CsvImportTrait;
    use ObtenerOrganizacion;

    public $modelo = 'EntendimientoOrganizacion';

    // public function index(Request $request)
    // {
    //     abort_if(Gate::denies('analisis_foda_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    //     //$obtener_FODA = EntendimientoOrganizacion::first();
    //     // $query = EntendimientoOrganizacion::with('empleado')->get();
    //     // dd($query);
    //     if ($request->ajax()) {
    //         $query = EntendimientoOrganizacion::with('empleado', 'participantes')->orderByDesc('id')->get();
    //         $table = Datatables::of($query);

    //         $table->addColumn('placeholder', '&nbsp;');
    //         $table->addColumn('actions', '&nbsp;');

    //         $table->editColumn('actions', function ($row) {
    //             $viewGate = 'analisis_foda_ver';
    //             $editGate = 'analisis_foda_editar';
    //             $deleteGate = 'analisis_foda_eliminar';
    //             $crudRoutePart = 'entendimiento-organizacions';

    //             return view('partials.datatablesActions', compact(
    //                 'viewGate',
    //                 'editGate',
    //                 'deleteGate',
    //                 'crudRoutePart',
    //                 'row'
    //             ));
    //         });
    //         $table->editColumn('id', function ($row) {
    //             return $row->id ? $row->id : '';
    //         });
    //         $table->editColumn('fortaleza', function ($row) {
    //             return $row->fortaleza ? strip_tags($row->fortaleza) : '';
    //         });
    //         $table->editColumn('oportunidades', function ($row) {
    //             return $row->oportunidades ? $row->oportunidades : '';
    //         });
    //         $table->editColumn('debilidades', function ($row) {
    //             return $row->debilidades ? $row->debilidades : '';
    //         });
    //         $table->editColumn('amenazas', function ($row) {
    //             return $row->amenazas ? $row->amenazas : '';
    //         });
    //         $table->editColumn('analisis', function ($row) {
    //             return $row->analisis ? $row->analisis : '';
    //         });
    //         $table->editColumn('fecha', function ($row) {
    //             return $row->fecha ? \Carbon\Carbon::parse($row->fecha)->format('d-m-Y') : '';
    //         });
    //         $table->editColumn('elabora', function ($row) {
    //             return $row->empleado ? $row->empleado->name : '';
    //         });

    //         $table->rawColumns(['actions', 'placeholder']);

    //         return $table->make(true);
    //     }

    //     $obtener_FODA = EntendimientoOrganizacion::first();
    //     $empleado = Empleado::getaltaAll();
    //     $teams = Team::get();

    //     return view('admin.entendimientoOrganizacions.index', compact('obtener_FODA', 'teams', 'empleado'));
    // }

    public function create()
    {
        abort_if(Gate::denies('analisis_foda_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $entendimientoOrganizacion = new EntendimientoOrganizacion;
        $empleados = Empleado::getaltaAll();
        $isEdit = false;
        $esta_vinculado = User::getCurrentUser()->empleado ? true : false;

        return view('admin.entendimientoOrganizacions.create', compact('isEdit', 'entendimientoOrganizacion', 'esta_vinculado', 'empleados'));
    }

    public function store(Request $request, EntendimientoOrganizacion $entendimientoOrganizacion)
    {
        abort_if(Gate::denies('analisis_foda_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            'analisis' => 'required|string|max:255',
            'fecha' => 'required|date',
            'id_elabora' => 'required|string',

        ], [
            'analisis.required' => 'El campo Análisis es obligatorio',
            'analisis.string' => 'El campo Análisis debe ser un texto',
            'analisis.max' => 'El campo Análisis debe tener como máximo 255 caracteres',
            'fecha.required' => 'El campo Fecha es obligatorio',
            'fecha.date' => 'El campo Fecha debe ser una fecha',
            'id_elabora.required' => 'El campo Elabora es obligatorio',
        ]);
        $foda = $entendimientoOrganizacion->create($request->all());
        // Almacenamiento de participantes relacionados
        if (!is_null($request->participantes)) {
            $this->vincularParticipantes($request->participantes, $foda);
        }

        // dd($foda);
        return redirect()->route('admin.foda-organizacions.edit', $foda)->with('success', 'Análisis FODA creado correctamente');
    }

    public function vincularParticipantes($participantesA, $model)
    {
        if (is_array($participantesA)) {
            $participantes = $participantesA;
        } else {
            $arrstrParticipantes = explode(',', $participantesA);
            $participantes = array_map(function ($valor) {
                return intval($valor);
            }, $arrstrParticipantes);
        }

        // dd($participantes);
        $model->participantes()->sync($participantes);
    }

    public function edit(EntendimientoOrganizacion $entendimientoOrganizacion)
    {
        abort_if(Gate::denies('analisis_foda_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $entendimientoOrganizacion->load('participantes');

        $empleados = Empleado::getaltaAll();

        $isEdit = true;

        $esta_vinculado = User::getCurrentUser()->empleado ? true : false;

        // $entendimiento->load('participantes');

        return view('admin.entendimientoOrganizacions.edit', compact('isEdit', 'entendimientoOrganizacion', 'esta_vinculado', 'empleados'));
    }

    public function update(Request $request, EntendimientoOrganizacion $entendimientoOrganizacion)
    {
        abort_if(Gate::denies('analisis_foda_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            'analisis' => 'required|string|max:255',
            'fecha' => 'required|date',
            'id_elabora' => 'required|string',

        ], [
            'analisis.required' => 'El campo Análisis es obligatorio',
            'analisis.string' => 'El campo Análisis debe ser un texto',
            'analisis.max' => 'El campo Análisis debe tener como máximo 255 caracteres',
            'fecha.required' => 'El campo Fecha es obligatorio',
            'fecha.date' => 'El campo Fecha debe ser una fecha',
            'id_elabora.required' => 'El campo Elabora es obligatorio',
        ]);

        $entendimientoOrganizacion->update($request->all());
        if (!is_null($request->participantes)) {
            $this->vincularParticipantes($request->participantes, $entendimientoOrganizacion);
        }

        return redirect()->route('admin.entendimiento-organizacions.index')->with('success', 'Análisis FODA actualizado correctamente');
    }

    public function show(EntendimientoOrganizacion $entendimientoOrganizacion)
    {
        abort_if(Gate::denies('analisis_foda_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $empleados = Empleado::getaltaAll();
        $obtener_FODA = $entendimientoOrganizacion;
        // dd($obtener_FODA);
        $fortalezas = FortalezasEntendimientoOrganizacion::where('foda_id', $entendimientoOrganizacion->id)->get();
        $oportunidades = OportunidadesEntendimientoOrganizacion::where('foda_id', $entendimientoOrganizacion->id)->get();
        $amenazas = AmenazasEntendimientoOrganizacion::where('foda_id', $entendimientoOrganizacion->id)->get();
        $debilidades = DebilidadesEntendimientoOrganizacion::where('foda_id', $entendimientoOrganizacion->id)->get();

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.entendimientoOrganizacions.show', compact('fortalezas', 'oportunidades', 'amenazas', 'debilidades', 'empleados', 'obtener_FODA', 'organizacion_actual', 'logo_actual', 'empresa_actual'));
    }

    public function destroy(EntendimientoOrganizacion $entendimientoOrganizacion)
    {
        abort_if(Gate::denies('analisis_foda_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $entendimientoOrganizacion->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');
    }

    public function massDestroy(MassDestroyEntendimientoOrganizacionRequest $request)
    {
        EntendimientoOrganizacion::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function duplicarFoda(Request $request)
    {
        $fodaOld = EntendimientoOrganizacion::with('participantes', 'fodafortalezas', 'fodaoportunidades', 'fodadebilidades', 'fodamenazas')->find($request->id);
        $participantes = $fodaOld->participantes->pluck('id')->toArray();
        $fortalezas = $fodaOld->fodafortalezas;
        $oportunidades = $fodaOld->fodaoportunidades;
        $debilidades = $fodaOld->fodadebilidades;
        $amenazas = $fodaOld->fodamenazas;

        $foda = EntendimientoOrganizacion::create([
            'analisis' => $request->nombreFoda,
            'fecha' => $fodaOld->fecha,
            'id_elabora' => $fodaOld->id_elabora,
        ]);
        // Almacenamiento de participantes relacionados
        $this->vincularParticipantes($participantes, $foda);
        foreach ($fortalezas as $fortaleza) {
            FortalezasEntendimientoOrganizacion::create([
                'foda_id' => $foda->id,
                'fortaleza' => $fortaleza->fortaleza,
                'riesgo' => $fortaleza->riesgo,
            ]);
        }

        foreach ($oportunidades as $oportunidad) {
            OportunidadesEntendimientoOrganizacion::create([
                'foda_id' => $foda->id,
                'oportunidad' => $oportunidad->oportunidad,
                'riesgo' => $oportunidad->riesgo,
            ]);
        }

        foreach ($debilidades as $debilidad) {
            DebilidadesEntendimientoOrganizacion::create([
                'foda_id' => $foda->id,
                'debilidad' => $debilidad->debilidad,
                'riesgo' => $debilidad->riesgo,
            ]);
        }

        foreach ($amenazas as $amenaza) {
            AmenazasEntendimientoOrganizacion::create([
                'foda_id' => $foda->id,
                'amenaza' => $amenaza->amenaza,
                'riesgo' => $amenaza->riesgo,
            ]);
        }

        return response()->json(['success' => true, 'analisis_creado' => $foda]);
    }

    // public function edit()
    // {
    //     abort_if(Gate::denies('entendimiento_organizacion_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    //     return view('admin.entendimiento-organizacion.edit');
    // }

    // public function massDestroy(MassDestroyAreaRequest $request)
    // {
    //     Area::whereIn('id', request('ids'))->delete();

    //     return response(null, Response::HTTP_NO_CONTENT);
    // }

    public function cardFoda()
    {
        abort_if(Gate::denies('analisis_foda_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $query = EntendimientoOrganizacion::with('empleado', 'participantes')->orderByDesc('id')->get();

        return view('admin.entendimientoOrganizacions.cardFoda', compact('query'));
    }

    public function foda($entendimientoOrganizacion)
    {
        abort_if(Gate::denies('analisis_foda_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $empleados = Empleado::getaltaAll();
        $foda_actual = $entendimientoOrganizacion;
        $obtener_FODA = EntendimientoOrganizacion::where('id', $entendimientoOrganizacion)->first();
        // $fortalezas = FortalezasEntendimientoOrganizacion::where('foda_id', $entendimientoOrganizacion)->get();
        $oportunidades = OportunidadesEntendimientoOrganizacion::where('foda_id', $entendimientoOrganizacion)->get();
        $amenazas = AmenazasEntendimientoOrganizacion::where('foda_id', $entendimientoOrganizacion)->get();
        $debilidades = DebilidadesEntendimientoOrganizacion::where('foda_id', $entendimientoOrganizacion)->get();
        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.entendimientoOrganizacions.cardFodaEdit', compact('oportunidades', 'amenazas', 'debilidades', 'empleados', 'obtener_FODA', 'organizacion_actual', 'logo_actual', 'empresa_actual', 'foda_actual'));
    }

    // public function cardFodaGeneral()
    public function index()
    {
        abort_if(Gate::denies('analisis_foda_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $query = EntendimientoOrganizacion::with('empleado', 'participantes')->orderByDesc('id')->get();

        $modulo = ListaDistribucion::with('participantes.empleado')->where('modelo', '=', $this->modelo)->first();

        if (!isset($modulo)) {
            $listavacia = 'vacia';
        } elseif ($modulo->participantes->isEmpty()) {
            $listavacia = 'vacia';
        } else {
            foreach ($modulo->participantes as $participante) {
                if ($participante->empleado->estatus != 'alta') {
                    $listavacia = 'baja';

                    return view('admin.entendimientoOrganizacions.cardFodaGeneral', compact('query', 'listavacia'));
                }
            }
            $listavacia = 'cumple';
        }

        return view('admin.entendimientoOrganizacions.cardFodaGeneral', compact('query', 'listavacia'));
    }

    public function revision($entendimientoOrganizacion)
    {
        abort_if(Gate::denies('analisis_foda_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $foda = EntendimientoOrganizacion::find($entendimientoOrganizacion);

        $modulo = ListaDistribucion::where('modelo', '=', $this->modelo)->first();

        $proceso = ProcesosListaDistribucion::with('participantes')
            ->where('modulo_id', '=', $modulo->id)
            ->where('proceso_id', '=', $entendimientoOrganizacion)
            ->first();

        $no_niveles = $modulo->niveles;

        // dd($proceso, $foda);
        if ($proceso->estatus == 'Pendiente') {
            for ($i = 1; $i <= $no_niveles; $i++) {
                foreach ($proceso->participantes as $part) {
                    if (
                        $part->participante->nivel == $i && $part->estatus == 'Pendiente'
                        && $part->participante->empleado_id == User::getCurrentUser()->empleado->id
                    ) {
                        for ($j = 1; $j <= 5; $j++) {
                            if (
                                $part->participante->numero_orden == $j && $part->estatus == 'Pendiente'
                                && $part->participante->empleado_id == User::getCurrentUser()->empleado->id
                            ) {

                                $empleados = Empleado::getaltaAll();
                                $foda_actual = $entendimientoOrganizacion;
                                $obtener_FODA = EntendimientoOrganizacion::where('id', $entendimientoOrganizacion)->first();
                                $organizacion_actual = $this->obtenerOrganizacion();
                                $logo_actual = $organizacion_actual->logo;
                                $empresa_actual = $organizacion_actual->empresa;

                                return view('admin.entendimientoOrganizacions.show-admin', compact('foda_actual', 'empleados', 'obtener_FODA', 'organizacion_actual', 'logo_actual', 'empresa_actual'));
                                break;
                            } else {
                                return redirect(route('admin.entendimiento-organizacions.index'));
                            }
                        }
                    } elseif (
                        $part->participante->nivel == 0 && $part->estatus == 'Pendiente'
                        && $part->participante->empleado_id == User::getCurrentUser()->empleado->id
                    ) {
                        $empleados = Empleado::getaltaAll();
                        $foda_actual = $entendimientoOrganizacion;
                        $obtener_FODA = EntendimientoOrganizacion::where('id', $entendimientoOrganizacion)->first();
                        $organizacion_actual = $this->obtenerOrganizacion();
                        $logo_actual = $organizacion_actual->logo;
                        $empresa_actual = $organizacion_actual->empresa;

                        return view('admin.entendimientoOrganizacions.show-admin', compact('foda_actual', 'empleados', 'obtener_FODA', 'organizacion_actual', 'logo_actual', 'empresa_actual'));
                        break;
                    }
                }
            }
        } else {
            return redirect(route('admin.entendimiento-organizacions.index'));
        }
    }

    public function solicitudAprobacion($id_foda)
    {
        // $modelo = 'EntendimientoOrganizacion';
        $foda = EntendimientoOrganizacion::find($id_foda);
        // dd($foda);
        $lista = ListaDistribucion::with('participantes')->where('modelo', '=', $this->modelo)->first();

        // $no_niveles = $lista->niveles;
        // dd($lista, $no_niveles);

        $proceso = ProcesosListaDistribucion::updateOrCreate(
            [
                'modulo_id' => $lista->id,
                'proceso_id' => $id_foda, //Este es solo el numero del id del respectivo FODA, no esta relacionado a nada, pero se necesita el valor
            ],
            [
                'estatus' => 'Pendiente',
            ]
        );
        // dd($lista, $id_foda, $this->modelo, $proceso);

        foreach ($lista->participantes as $participante) {
            $participantes = ControlListaDistribucion::updateOrCreate(
                [
                    'proceso_id' => $proceso->id,
                    'participante_id' => $participante->id,
                ],
                [
                    'estatus' => 'Pendiente',
                ]
            );
        }

        //Superaprobadores
        foreach ($proceso->participantes as $part) {
            if ($part->participante->nivel == 0) {
                $emailSuperAprobador = $part->participante->empleado->email;
                //Mail::to(removeUnicodeCharacters($emailSuperAprobador))->send(new NotificacionSolicitudAprobacionAnalisisFODA($foda->id, $foda->analisis));
                // dd('primer usuario', $part->participante);
            }
        }

        //Aprobadores normales
        // for ($i = 1; $i <= $no_niveles; $i++) {
        foreach ($proceso->participantes as $part) {
            if ($part->participante->nivel == 1) {
                // for ($j = 1; $j <= 5; $j++) {
                if ($part->participante->numero_orden == 1) {
                    $emailAprobador = $part->participante->empleado->email;
                    //Mail::to(removeUnicodeCharacters($emailAprobador))->send(new NotificacionSolicitudAprobacionAnalisisFODA($foda->id, $foda->analisis));
                    break;
                }
                // }
            }
            // }
        }

        // $control_participantes = ControlListaDistribucion::where('proceso_id', '=', $proceso->id)->get();
        // dd($proceso, $control_participantes);
        return redirect(route('admin.entendimiento-organizacions.index'));
    }

    public function aprobado($id, Request $request)
    {
        $aprobador = User::getCurrentUser()->empleado->id;

        $foda = EntendimientoOrganizacion::find($id);

        $modulo = ListaDistribucion::where('modelo', '=', $this->modelo)->first();

        $proceso_general = ProcesosListaDistribucion::with('participantes')
            ->where('modulo_id', '=', $modulo->id)
            ->where('proceso_id', '=', $id)
            ->with([
                'modulo' => function ($query) {
                    $query->where('modelo', '=', $this->modelo);
                },
            ])
            ->first();

        $proceso = ProcesosListaDistribucion::with([
            'modulo' => function ($query) {
                $query->where('modelo', '=', $this->modelo);
            },
            'participantes' => function ($query) use ($aprobador) {
                $query->whereHas('participante', function ($subQuery) use ($aprobador) {
                    $subQuery->where('empleado_id', '=', $aprobador);
                });
            },
        ])->where('modulo_id', '=', $modulo->id)
            ->where('proceso_id', '=', $id)
            ->first();

        $comentario = ComentariosProcesosListaDistribucion::create([
            'comentario' => $request->comentario,
            'proceso_id' => $proceso->id,
        ]);
        // dd($proceso);
        $participante_control = $proceso->participantes[0];
        $participante = $proceso->participantes[0]->participante;

        // dd($id, $request->all(), $aprobador, $proceso, $participante);
        //SuperAprobador
        if ($participante->nivel == 0) {
            // dd("superaprobador");
            $proceso->update([
                'estatus' => 'Aprobado',
            ]);

            foreach ($proceso_general->participantes as $p) {
                $p->update([
                    'estatus' => 'Aprobado',
                ]);
            }

            $foda->update([
                'estatus' => 'Aprobado',
            ]);

            $this->correosAprobacion($proceso, $foda);
        } else {
            // dd($participante_control);
            $participante_control->update([
                'estatus' => 'Aprobado',
            ]);
            $this->confirmacionAprobacion($proceso_general, $foda);
        }

        return redirect(route('admin.entendimiento-organizacions.index'));
    }

    public function correosAprobacion($proceso, $foda)
    {
        $procesoAprobado = ProcesosListaDistribucion::with('participantes')->find($proceso->id);
        // dd($procesoAprobado);
        foreach ($procesoAprobado->participantes as $part) {
            $emailAprobado = $part->participante->empleado->email;
            //Mail::to(removeUnicodeCharacters($emailAprobado))->send(new NotificacionSolicitudAprobacionAnalisisFODA($foda->analisis));
            // dd('primer usuario', $part->participante);
        }
    }

    public function rechazado($id, Request $request)
    {
        // dd($id, $request->all());
        $foda = EntendimientoOrganizacion::with('empleado')->find($id);
        $modulo = ListaDistribucion::where('modelo', '=', $this->modelo)->first();
        $aprobacion = ProcesosListaDistribucion::with('participantes')->where('proceso_id', '=', $id)->where('modulo_id', '=', $modulo->id)->first();
        // dd($aprobacion);

        $comentario = ComentariosProcesosListaDistribucion::create([
            'comentario' => $request->comentario,
            'proceso_id' => $aprobacion->id,
        ]);

        $foda->update([
            'estatus' => 'Rechazado',
        ]);

        $aprobacion->update([
            'estatus' => 'Rechazado',
        ]);

        foreach ($aprobacion->participantes as $p) {
            $p->update([
                'estatus' => 'Rechazado',
            ]);
        }
        // $responsable = $minuta->responsable->name;
        $emailresponsable = $foda->empleado->email;
        $analisis_foda = $foda->analisis;

        //Mail::to(removeUnicodeCharacters($emailresponsable))->send(new NotificacionRechazoAnalisisFODALider($foda->id, $analisis_foda));

        foreach ($aprobacion->participantes as $participante) {
            //Mail::to(removeUnicodeCharacters($participante->email))->send(new NotificacionRechazoAnalisisFODA($analisis_foda));
        }

        return redirect(route('admin.entendimiento-organizacions.index'));
    }

    public function confirmacionAprobacion($proceso, $foda)
    {
        $confirmacion = ControlListaDistribucion::where('proceso_id', '=', $proceso->id)
            ->get();

        $isSameEstatus = $confirmacion->every(function ($record) {
            return $record->estatus == 'Aprobado'; // Assuming 'estatus' is the column name
        });
        // dd($confirmacion, $isSameEstatus);
        if ($isSameEstatus) {
            $proceso->update([
                'estatus' => 'Aprobado',
            ]);

            $foda->update([
                'estatus' => 'Aprobado',
            ]);

            $this->correosAprobacion($proceso->id, $foda);
        } else {
            $this->siguienteCorreo($proceso, $foda);
        }
    }

    public function siguienteCorreo($proceso, $foda)
    {
        $lista = ListaDistribucion::with('participantes')->where('modelo', '=', $this->modelo)->first();

        $no_niveles = $lista->niveles;

        // dd($proceso, $foda);

        for ($i = 1; $i <= $no_niveles; $i++) {
            foreach ($proceso->participantes as $part) {
                if ($part->participante->nivel == $i && $part->estatus == 'Pendiente') {
                    for ($j = 1; $j <= 5; $j++) {
                        if ($part->participante->numero_orden == $j && $part->estatus == 'Pendiente') {
                            $emailAprobador = $part->participante->empleado->email;
                            // dd($emailAprobador);
                            //Mail::to(removeUnicodeCharacters($emailAprobador))->send(new NotificacionSolicitudAprobacionAnalisisFODA($foda->id, $foda->analisis));
                            break;
                        }
                    }
                }
            }
        }
    }
}
