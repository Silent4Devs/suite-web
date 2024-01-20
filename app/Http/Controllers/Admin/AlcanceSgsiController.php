<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAlcanceSgsiRequest;
use App\Mail\DeterminacionAlcance\NotificacionAprobacionAlcance;
use App\Mail\DeterminacionAlcance\NotificacionRechazoAlcance;
use App\Mail\DeterminacionAlcance\NotificacionRechazoAlcanceLider;
use App\Mail\DeterminacionAlcance\NotificacionSolicitudAprobacionAlcance;
use App\Models\AlcanceSgsi;
use App\Models\ComentariosProcesosListaDistribucion;
use App\Models\ControlListaDistribucion;
use App\Models\Empleado;
use App\Models\ListaDistribucion;
use App\Models\Norma;
use App\Models\Organizacion;
use App\Models\ProcesosListaDistribucion;
use App\Models\Team;
use App\Models\User;
use App\Traits\ObtenerOrganizacion;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PDF;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AlcanceSgsiController extends Controller
{
    use ObtenerOrganizacion;

    public $modelo = 'AlcanceSgsi';

    public function index(Request $request)
    {
        abort_if(Gate::denies('determinacion_alcance_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $alcanceSgsi = AlcanceSgsi::get(); // Puedes ajustar esto según tu lógica

        if ($request->ajax()) {
            $query = AlcanceSgsi::select(sprintf('%s.*', (new AlcanceSgsi)->table))->orderByDesc('id');
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'determinacion_alcance_ver';
                $editGate = 'determinacion_alcance_editar';
                $deleteGate = 'determinacion_alcance_eliminar';
                $crudRoutePart = 'alcance-sgsis';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('nombre', function ($row) {
                return $row->nombre ? strip_tags($row->nombre) : '';
            });
            $table->editColumn('alcancesgsi', function ($row) {
                return $row->alcancesgsi ? html_entity_decode(strip_tags($row->alcancesgsi), ENT_QUOTES, 'UTF-8') : '';
            });

            $table->editColumn('norma', function ($row) {
                return $row->normas ? $row->normas : '';
            });

            $table->editColumn('estatus', function ($row) {
                return $row->estatus ? $row->estatus : '';
            });

            $table->editColumn('fecha_publicacion', function ($row) {
                return $row->fecha_publicacion ? $row->fecha_publicacion : '';
            });
            $table->editColumn('fecha_entrada', function ($row) {
                return $row->fecha_entrada ? $row->fecha_entrada : '';
            });
            $table->editColumn('reviso_alcance', function ($row) {
                return $row->empleado ? $row->empleado->name : '';
            });
            $table->editColumn('puesto_reviso', function ($row) {
                return $row->empleado ? $row->empleado->puesto : '';
            });
            $table->editColumn('area_reviso', function ($row) {
                return $row->empleado ? $row->empleado->area->area : '';
            });
            $table->editColumn('fecha_revision', function ($row) {
                return $row->fecha_revision ? $row->fecha_revision : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $teams = Team::get();
        $empleados = Empleado::getAltaEmpleadosWithArea();
        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;
        $direccion = $organizacion_actual->direccion;
        $rfc = $organizacion_actual->rfc;
        $normas = Norma::get();

        $modulo = ListaDistribucion::with('participantes.empleado')->where('modelo', '=', $this->modelo)->first();

        if (!isset($modulo)) {
            $listavacia = 'vacia';
        } elseif ($modulo->participantes->isEmpty()) {
            $listavacia = 'vacia';
        } else {
            foreach ($modulo->participantes as $participante) {
                if ($participante->empleado->estatus != 'alta') {
                    $listavacia = 'baja';

                    return view('admin.alcanceSgsis.index', compact('alcanceSgsi', 'listavacia', 'teams', 'empleados', 'organizacion_actual', 'logo_actual', 'empresa_actual', 'direccion', 'rfc'));
                }
            }
            $listavacia = 'cumple';
        }

        return view('admin.alcanceSgsis.index', compact('alcanceSgsi', 'listavacia', 'teams', 'empleados', 'organizacion_actual', 'logo_actual', 'empresa_actual', 'direccion', 'rfc'));
    }

    public function create()
    {
        abort_if(Gate::denies('determinacion_alcance_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $empleados = Empleado::with('area')->get();
        $normas = Norma::get();

        return view('admin.alcanceSgsis.create', compact('empleados', 'normas'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('determinacion_alcance_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'nombre' => 'required|string',
            'alcancesgsi' => 'required|string',
            'fecha_publicacion' => 'required|date',
            'fecha_revision' => 'required|date',
        ]);

        $alcanceSgsi = AlcanceSgsi::create([
            'nombre' => $request->input('nombre'),
            'alcancesgsi' => $request->input('alcancesgsi'),
            'fecha_publicacion' => $request->input('fecha_publicacion'),
            'fecha_revision' => $request->input('fecha_revision'),
            'estatus' => 'Pendiente',
            'id_reviso_alcance' => User::getCurrentUser()->empleado->id, //Para saber quien lo elaboro/responsable
        ]);

        $this->solicitudAprobacion($alcanceSgsi->id);

        return redirect()->route('admin.alcance-sgsis.index')->with('success', 'Guardado con éxito');
    }

    public function edit(AlcanceSgsi $alcanceSgsi)
    {
        abort_if(Gate::denies('determinacion_alcance_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $alcanceSgsi->load('normas');
        $normas_seleccionadas = $alcanceSgsi->normas->pluck('id')->toArray();

        $normas = Norma::get();
        $empleados = Empleado::getAltaEmpleadosWithArea();

        return view('admin.alcanceSgsis.edit', compact('alcanceSgsi', 'empleados', 'normas', 'normas_seleccionadas'));
    }

    public function aprove(AlcanceSgsi $alcanceSgsi)
    {
        abort_if(Gate::denies('determinacion_alcance_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $alcanceSgsi->load('normas');
        $normas_seleccionadas = $alcanceSgsi->normas->pluck('id')->toArray();

        $normas = Norma::get();
        $empleados = Empleado::alta()->with('area')->get();

        return view('admin.alcanceSgsis.aprove', compact('alcanceSgsi', 'empleados', 'normas', 'normas_seleccionadas'));
    }

    public function update(Request $request, AlcanceSgsi $alcanceSgsi)
    {
        abort_if(Gate::denies('determinacion_alcance_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            'nombre' => 'required|string',
            'alcancesgsi' => 'required|string',
            'fecha_publicacion' => 'required|date',
            'fecha_revision' => 'required|date',
        ]);

        $alcanceSgsi->update([
            'nombre' => $request->input('nombre'),
            'alcancesgsi' => $request->input('alcancesgsi'),
            'fecha_publicacion' => $request->input('fecha_publicacion'),
            'fecha_revision' => $request->input('fecha_revision'),
            'estatus' => 'Pendiente',
        ]);

        $this->solicitudAprobacion($alcanceSgsi->id);

        return redirect()->route('admin.alcance-sgsis.index')->with('success', 'Editado con éxito');
    }

    public function show(AlcanceSgsi $alcanceSgsi)
    {
        abort_if(Gate::denies('determinacion_alcance_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $alcanceSgsi->load('team');
        $normas = Norma::get();

        return view('admin.alcanceSgsis.show', compact('alcanceSgsi', 'normas'));
    }

    public function destroy(AlcanceSgsi $alcanceSgsi)
    {
        abort_if(Gate::denies('determinacion_alcance_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $alcanceSgsi->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');
    }

    public function massDestroy(MassDestroyAlcanceSgsiRequest $request)
    {
        AlcanceSgsi::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function pdf()
    {

        $alcances = AlcanceSgsi::get();
        $organizacions = Organizacion::getFirst();

        $pdf = PDF::loadView('alcances', compact('alcances', 'organizacions'));
        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('alcances.pdf');
    }

    public function solicitudAprobacion($id_alcance)
    {
        // $modelo = 'AlcanceSgsi';
        $alcance = AlcanceSgsi::find($id_alcance);
        // dd($alcance);
        $lista = ListaDistribucion::with('participantes')->where('modelo', '=', $this->modelo)->first();

        // $no_niveles = $lista->niveles;
        // dd($lista, $no_niveles);

        $proceso = ProcesosListaDistribucion::updateOrCreate(
            [
                'modulo_id' => $lista->id,
                'proceso_id' => $id_alcance, //Este es solo el numero del id del respectivo FODA, no esta relacionado a nada, pero se necesita el valor
            ],
            [
                'estatus' => 'Pendiente',
            ]
        );
        // dd($lista, $id_alcance, $this->modelo, $proceso);

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
                Mail::to(removeUnicodeCharacters($emailSuperAprobador))->queue(new NotificacionSolicitudAprobacionAlcance($alcance->id, $alcance->nombre));
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
                    Mail::to(removeUnicodeCharacters($emailAprobador))->queue(new NotificacionSolicitudAprobacionAlcance($alcance->id, $alcance->nombre));
                    break;
                }
                // }
            }
            // }
        }

        // $control_participantes = ControlListaDistribucion::where('proceso_id', '=', $proceso->id)->get();
        // dd($proceso, $control_participantes);
    }

    public function revision($id)
    {
        abort_if(Gate::denies('analisis_foda_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // dd('Llega', $alcanceSgsi);

        $alcanceSgsi = AlcanceSgsi::find($id);
        // dd($alcanceSgsi);
        $modulo = ListaDistribucion::where('modelo', '=', $this->modelo)->first();

        $alcanceSgsi->load('team');
        $normas = Norma::get();

        $proceso = ProcesosListaDistribucion::with('participantes')
            ->where('modulo_id', '=', $modulo->id)
            ->where('proceso_id', '=', $alcanceSgsi->id)
            ->first();

        $no_niveles = $modulo->niveles;

        $acceso_restringido = 'correcto';

        if ($proceso->estatus == 'Pendiente') {
            for ($i = 1; $i <= $no_niveles; $i++) {
                foreach ($proceso->participantes as $part) {
                    // dd($part, $part->participante, $part->participante->control($proceso->id), $part->estatus);
                    if (
                        $part->participante->nivel == $i && $part->estatus == 'Pendiente'
                        && $part->participante->empleado_id == User::getCurrentUser()->empleado->id
                    ) {

                        for ($j = 1; $j <= 5; $j++) {
                            if (
                                $part->participante->numero_orden == $j && $part->estatus == 'Pendiente'
                                && $part->participante->empleado_id == User::getCurrentUser()->empleado->id
                            ) {
                                // dd($proceso);
                                // dd($alcanceSgsi, $part);

                                return view('admin.alcanceSgsis.revision', compact('alcanceSgsi', 'normas', 'acceso_restringido'));
                                break;
                            } else {
                                $acceso_restringido = 'turno';
                                return view('admin.alcanceSgsis.revision', compact('alcanceSgsi', 'normas', 'acceso_restringido'));
                            }
                        }
                    } elseif (
                        $part->participante->nivel == 0 && $part->estatus == 'Pendiente'
                        && $part->participante->empleado_id == User::getCurrentUser()->empleado->id
                    ) {

                        return view('admin.alcanceSgsis.revision', compact('alcanceSgsi', 'normas', 'acceso_restringido'));
                        break;
                    }
                }
            }
            $acceso_restringido = 'denegado';
            return view('admin.alcanceSgsis.revision', compact('alcanceSgsi', 'normas', 'acceso_restringido'));
        } else {
            $acceso_restringido = 'aprobado';
            return view('admin.alcanceSgsis.revision', compact('alcanceSgsi', 'normas', 'acceso_restringido'));
        }
    }

    public function aprobado($id, Request $request)
    {
        // dd($id, $request->all());
        $aprobador = User::getCurrentUser()->empleado->id;

        $alcance = AlcanceSgsi::find($id);

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

            $alcance->update([
                'estatus' => 'Aprobado',
            ]);

            $this->correosAprobacion($proceso, $alcance);
        } else {
            // dd($participante_control);
            $participante_control->update([
                'estatus' => 'Aprobado',
            ]);
            $this->confirmacionAprobacion($proceso_general, $alcance);
        }

        return redirect(route('admin.alcance-sgsis.index'));
    }

    public function correosAprobacion($proceso, $alcance)
    {
        $procesoAprobado = ProcesosListaDistribucion::with('participantes')->find($proceso);
        foreach ($procesoAprobado->participantes as $part) {
            $emailAprobado = $part->participante->empleado->email;
            Mail::to(removeUnicodeCharacters($emailAprobado))->queue(new NotificacionAprobacionAlcance($alcance->nombre));
            // dd('primer usuario', $part->participante);
        }
    }

    public function rechazado($id, Request $request)
    {
        // dd($id, $request->all());
        $alcance = AlcanceSgsi::with('empleado')->find($id);
        $modulo = ListaDistribucion::where('modelo', '=', $this->modelo)->first();
        $aprobacion = ProcesosListaDistribucion::with('participantes')->where('proceso_id', '=', $id)->where('modulo_id', '=', $modulo->id)->first();
        // dd($aprobacion);

        $comentario = ComentariosProcesosListaDistribucion::create([
            'comentario' => $request->comentario,
            'proceso_id' => $aprobacion->id,
        ]);

        $alcance->update([
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
        $emailresponsable = $alcance->empleado->email;
        $alcance_nombre = $alcance->nombre;
        // dd($emailresponsable, $alcance_nombre);
        Mail::to(removeUnicodeCharacters($emailresponsable))->queue(new NotificacionRechazoAlcanceLider($alcance->id, $alcance_nombre));

        foreach ($aprobacion->participantes as $participante) {
            Mail::to(removeUnicodeCharacters($participante->email))->queue(new NotificacionRechazoAlcance($alcance_nombre));
        }

        return redirect(route('admin.alcance-sgsis.index'));
    }

    public function confirmacionAprobacion($proceso, $alcance)
    {
        $confirmacion = ControlListaDistribucion::with('proceso')->where('proceso_id', '=', $proceso->id)
            ->withwhereHas('participante', function ($query) {
                return $query->where('nivel', '>', 0);
            })->get();

        $isSameEstatus = $confirmacion->every(function ($record) {
            return $record->estatus == 'Aprobado'; // Assuming 'estatus' is the column name
        });
        // dd($confirmacion, $isSameEstatus);
        if ($isSameEstatus) {
            $proceso->update([
                'estatus' => 'Aprobado',
            ]);

            $alcance->update([
                'estatus' => 'Aprobado',
            ]);
            // dd($proceso, $alcance);
            $this->correosAprobacion($proceso->id, $alcance);
        } else {
            $this->siguienteCorreo($proceso, $alcance);
        }
    }

    public function visualizacion()
    {
        $alcances = AlcanceSgsi::where('estatus', 'Aprobado')->get();

        $organizacions = Organizacion::getFirst();

        return view('admin.alcanceSgsis.visualizacion', compact('alcances', 'organizacions'));
    }

    public function siguienteCorreo($proceso, $alcance)
    {
        $lista = ListaDistribucion::with('participantes')->where('modelo', '=', $this->modelo)->first();

        $no_niveles = $lista->niveles;

        for ($i = 1; $i <= $no_niveles; $i++) {
            foreach ($proceso->participantes as $part) {
                if ($part->participante->nivel == $i && $part->estatus == 'Pendiente') {
                    for ($j = 1; $j <= 5; $j++) {
                        if ($part->participante->numero_orden == $j && $part->estatus == 'Pendiente') {
                            $emailAprobador = $part->participante->empleado->email;
                            // dd($emailAprobador);
                            Mail::to(removeUnicodeCharacters($emailAprobador))->queue(new NotificacionSolicitudAprobacionAlcance($alcance->id, $alcance->nombre));
                            break;
                        }
                    }
                }
            }
        }
    }
}
