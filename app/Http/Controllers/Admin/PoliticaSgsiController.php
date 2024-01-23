<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPoliticaSgsiRequest;
use App\Http\Requests\StorePoliticaSgsiRequest;
use App\Http\Requests\UpdatePoliticaSgsiRequest;
use App\Mail\PoliticasSGSI\NotificacionAprobacionPolitica;
use App\Mail\PoliticasSGSI\NotificacionRechazoPolitica;
use App\Mail\PoliticasSGSI\NotificacionRechazoPoliticaLider;
use App\Mail\PoliticasSGSI\NotificacionSolicitudAprobacionPolitica;
use App\Models\ComentariosProcesosListaDistribucion;
use App\Models\ControlListaDistribucion;
use App\Models\Empleado;
use App\Models\ListaDistribucion;
use App\Models\Organizacion;
use App\Models\PoliticaSgsi;
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

class PoliticaSgsiController extends Controller
{
    use ObtenerOrganizacion;

    public $modelo = 'PoliticaSgsi';

    public function index(Request $request)
    {
        abort_if(Gate::denies('politica_sistema_gestion_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $query = PoliticaSgsi::orderByDesc('id')->get();
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'politica_sistema_gestion_ver';
                $editGate = 'politica_sistema_gestion_editar';
                $deleteGate = 'politica_sistema_gestion_eliminar';
                $crudRoutePart = 'politica-sgsis';

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
            $table->editColumn('nombre_politica', function ($row) {
                return $row->nombre_politica ? $row->nombre_politica : '';
            });
            $table->editColumn('politicasgsi', function ($row) {
                return $row->politicasgsi ? html_entity_decode(strip_tags($row->politicasgsi), ENT_QUOTES, 'UTF-8') : '';
            });
            $table->editColumn('estatus', function ($row) {
                return $row->estatus ? $row->estatus : '';
            });

            $table->editColumn('mostrar', function ($row) {
                return $row->mostrar ? $row->mostrar : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $politicaSgsis = PoliticaSgsi::getAll();

        $teams = Team::get();

        $empleados = Empleado::getAltaEmpleadosWithArea();

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;
        $direccion = $organizacion_actual->direccion;
        $rfc = $organizacion_actual->rfc;

        $modulo = ListaDistribucion::with('participantes')->where('modelo', '=', $this->modelo)->first();

        $listavacia = 'cumple';
        if (! isset($modulo)) {
            $listavacia = 'vacia';
        } elseif ($modulo->participantes->isEmpty()) {
            $listavacia = 'vacia';
        } else {
            foreach ($modulo->participantes as $participante) {
                if ($participante->empleado->estatus != 'alta') {
                    $listavacia = 'baja';

                    return view('admin.politicaSgsis.index', compact(
                        'politicaSgsis',
                        'teams',
                        'empleados',
                        'organizacion_actual',
                        'logo_actual',
                        'empresa_actual',
                        'direccion',
                        'rfc',
                        'listavacia',
                    ));
                }
            }
        }

        return view('admin.politicaSgsis.index', compact(
            'politicaSgsis',
            'teams',
            'empleados',
            'organizacion_actual',
            'logo_actual',
            'empresa_actual',
            'direccion',
            'rfc',
            'listavacia',
        ));
    }

    public function create()
    {
        abort_if(Gate::denies('politica_sistema_gestion_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $empleados = Empleado::getAltaEmpleadosWithArea();

        return view('admin.politicaSgsis.create', compact('empleados'));
    }

    public function store(StorePoliticaSgsiRequest $request)
    {
        abort_if(Gate::denies('politica_sistema_gestion_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'nombre_politica' => 'required',
            'politicasgsi' => 'required',
            'fecha_publicacion' => 'required|date',
            'fecha_revision' => 'required|date',
        ]);

        $politicaSgsi = PoliticaSgsi::create([
            'nombre_politica' => $request->input('nombre_politica'),
            'politicasgsi' => $request->input('politicasgsi'),
            'fecha_publicacion' => $request->input('fecha_publicacion'),
            'fecha_revision' => $request->input('fecha_revision'),
            'estatus' => 'Pendiente',
            'id_reviso_politica' => User::getCurrentUser()->empleado->id,
        ]);

        //envio de corrreo
        $this->solicitudAprobacion($politicaSgsi->id);

        $politicaSgsi->estatus = 'Pendiente';

        return redirect()->route('admin.politica-sgsis.index')->with('success', 'Guardado con éxito');
    }

    public function edit(PoliticaSgsi $politicaSgsi)
    {
        abort_if(Gate::denies('politica_sistema_gestion_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $politicaSgsi->load('team');

        $empleados = Empleado::getAltaEmpleadosWithArea();

        $fecha_publicacion = \Carbon\Carbon::parse($politicaSgsi->fecha_publicacion)->format('Y-m-d');
        $fecha_revision = \Carbon\Carbon::parse($politicaSgsi->fecha_revision)->format('Y-m-d');

        $lista = ListaDistribucion::with('participantes')->where('modelo', '=', $this->modelo)->first();
        $proceso = ProcesosListaDistribucion::with('comentarios')->where('modulo_id', '=', $lista->id)->where('proceso_id', '=', $politicaSgsi->id)->first();
        if (isset($proceso->comentarios)) {
            $comentarios = $proceso->comentarios;
        } else {
            $comentarios = [];
        }
        // dd($politicaSgsi);

        return view('admin.politicaSgsis.edit', compact('politicaSgsi', 'empleados', 'fecha_publicacion', 'fecha_revision', 'comentarios'));
    }

    public function update(UpdatePoliticaSgsiRequest $request, PoliticaSgsi $politicaSgsi)
    {
        abort_if(Gate::denies('politica_sistema_gestion_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'nombre_politica' => 'required',
            'politicasgsi' => 'required',
            // 'id_reviso_politica' => 'required',
            'fecha_publicacion' => 'required',
            'fecha_revision' => 'required',
        ]);

        $politicaSgsi->update([
            'nombre_politica' => $request->input('nombre_politica'),
            'politicasgsi' => $request->input('politicasgsi'),
            'fecha_publicacion' => $request->input('fecha_publicacion'),
            'fecha_revision' => $request->input('fecha_revision'),
            'estatus' => 'Pendiente',
            'id_reviso_politica' => User::getCurrentUser()->empleado->id,
        ]);

        $this->solicitudAprobacion($politicaSgsi->id);

        return redirect()->route('admin.politica-sgsis.index')->with('success', 'Editado con éxito');
    }

    public function show(PoliticaSgsi $politicaSgsi)
    {
        abort_if(Gate::denies('politica_sistema_gestion_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $politicaSgsi->load('team');

        return view('admin.politicaSgsis.show', compact('politicaSgsi'));
    }

    public function destroy(PoliticaSgsi $politicaSgsi)
    {
        abort_if(Gate::denies('politica_sistema_gestion_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $politicaSgsi->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');
    }

    public function massDestroy(MassDestroyPoliticaSgsiRequest $request)
    {
        PoliticaSgsi::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function cambioMostrar(Request $request)
    {
        $id = $request->input('valorCheckbox');
        // dd($valorCheckbox);
        // Your logic here
        $politica = PoliticaSgsi::find($id);

        if ($politica->mostrar == false) {
            $politica->update([
                'mostrar' => true,
            ]);
        } elseif ($politica->mostrar == true) {
            $politica->update([
                'mostrar' => false,
            ]);
        }

        // Return a response if needed
        return response()->json(['message' => 'Success', 'valorCheckbox' => $id]);
    }

    public function visualizacion()
    {
        $politicaSgsis = PoliticaSgsi::where('estatus', 'Aprobado')->where('mostrar', '=', true)->get();
        foreach ($politicaSgsis as $polsgsis) {
            if (! isset($polsgsis->reviso)) {
                $polsgsis->revisobaja = PoliticaSgsi::with('revisobaja')->first();
                $polsgsis->estemp = 'baja';
            } else {
                $polsgsis->estemp = 'alta';
            }
        }
        $organizacions = Organizacion::getFirst();

        return view('admin.politicaSgsis.visualizacion', compact('politicaSgsis', 'organizacions'));
    }

    public function pdf()
    {

        $politicas = PoliticaSgsi::get();
        $organizacions = Organizacion::getFirst();
        $logo_actual = $organizacions->logo;

        $pdf = PDF::loadView('pdf', compact('politicas', 'organizacions', 'logo_actual'));
        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('politicas.pdf');
    }

    public function solicitudAprobacion($id_politica)
    {
        // $modelo = 'PoliticaSgsi';
        $politica = PoliticaSgsi::find($id_politica);
        // dd($politica);
        $lista = ListaDistribucion::with('participantes')->where('modelo', '=', $this->modelo)->first();

        // $no_niveles = $lista->niveles;
        // dd($lista, $no_niveles);

        $proceso = ProcesosListaDistribucion::updateOrCreate(
            [
                'modulo_id' => $lista->id,
                'proceso_id' => $id_politica, //Este es solo el numero del id del respectivo FODA, no esta relacionado a nada, pero se necesita el valor
            ],
            [
                'estatus' => 'Pendiente',
            ]
        );
        // dd($lista, $id_politica, $this->modelo, $proceso);

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
                Mail::to(removeUnicodeCharacters($emailSuperAprobador))->queue(new NotificacionSolicitudAprobacionPolitica($politica->id, $politica->nombre_politica));
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
                    Mail::to(removeUnicodeCharacters($emailAprobador))->queue(new NotificacionSolicitudAprobacionPolitica($politica->id, $politica->nombre_politica));
                    break;
                }
                // }
            }
            // }
        }
    }

    public function revision($id)
    {
        abort_if(Gate::denies('politica_sistema_gestion_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // dd('Llega', $politicaSgsi);

        $politicaSgsi = PoliticaSgsi::find($id);
        // dd($politicaSgsi);
        $politicaSgsi->load('team');
        $modulo = ListaDistribucion::where('modelo', '=', $this->modelo)->first();

        $proceso = ProcesosListaDistribucion::with('participantes')
            ->where('modulo_id', '=', $modulo->id)
            ->where('proceso_id', '=', $politicaSgsi->id)
            ->first();

        $no_niveles = $modulo->niveles;

        $acceso_restringido = 'correcto';
        // dd($proceso);
        if ($proceso->estatus == 'Pendiente') {
            for ($i = 0; $i <= $no_niveles; $i++) {
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
                                // dd($proceso);
                                // dd($politicaSgsi, $part);

                                // dd($politicaSgsi);
                                return view('admin.politicaSgsis.revision', compact('politicaSgsi', 'acceso_restringido'));
                                break;
                            } else {
                                $acceso_restringido = 'turno';

                                return view('admin.politicaSgsis.revision', compact('politicaSgsi', 'acceso_restringido'));
                            }
                        }
                    } elseif (
                        $part->participante->nivel == 0 && $part->estatus == 'Pendiente'
                        && $part->participante->empleado_id == User::getCurrentUser()->empleado->id
                    ) {

                        // dd($politicaSgsi);
                        return view('admin.politicaSgsis.revision', compact('politicaSgsi', 'acceso_restringido'));
                        break;
                    }
                }
            }
            $acceso_restringido = 'denegado';

            return view('admin.politicaSgsis.revision', compact('politicaSgsi', 'acceso_restringido'));
        } else {
            $acceso_restringido = 'aprobado';

            return view('admin.politicaSgsis.revision', compact('politicaSgsi', 'acceso_restringido'));
        }
    }

    public function aprobado($id, Request $request)
    {
        // dd($id, $request->all());
        $aprobador = User::getCurrentUser()->empleado->id;

        $politica = PoliticaSgsi::find($id);

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

            $politica->update([
                'estatus' => 'Aprobado',
            ]);

            $this->correosAprobacion($proceso, $politica);
        } else {
            // dd($participante_control);
            $participante_control->update([
                'estatus' => 'Aprobado',
            ]);
            $this->confirmacionAprobacion($proceso_general, $politica);
        }

        return redirect(route('admin.politica-sgsis.index'));
    }

    public function correosAprobacion($proceso, $politica)
    {
        $procesoAprobado = ProcesosListaDistribucion::with('participantes')->find($proceso);
        foreach ($procesoAprobado->participantes as $part) {
            $emailAprobado = $part->participante->empleado->email;

            Mail::to(removeUnicodeCharacters($emailAprobado))->queue(new NotificacionAprobacionPolitica($politica->nombre_politica));
            // dd('primer usuario', $part->participante);
        }
    }

    public function rechazado($id, Request $request)
    {
        // dd($id, $request->all());
        $politica = PoliticaSgsi::with('reviso')->find($id);
        $modulo = ListaDistribucion::where('modelo', '=', $this->modelo)->first();
        $aprobacion = ProcesosListaDistribucion::with('participantes')->where('proceso_id', '=', $id)->where('modulo_id', '=', $modulo->id)->first();
        // dd($aprobacion);

        $comentario = ComentariosProcesosListaDistribucion::create([
            'comentario' => $request->comentario,
            'proceso_id' => $aprobacion->id,
        ]);

        $aprobacion->update([
            'estatus' => 'Rechazado',
        ]);

        $politica->update(
            [
                'estatus' => 'Rechazado',
            ]
        );

        foreach ($aprobacion->participantes as $p) {
            $p->update([
                'estatus' => 'Rechazado',
            ]);
        }
        $emailresponsable = $politica->reviso->email;
        // dd($emailresponsable);
        Mail::to(removeUnicodeCharacters($emailresponsable))->queue(new NotificacionRechazoPoliticaLider($politica->id, $politica->nombre_politica));

        foreach ($aprobacion->participantes as $participante) {
            Mail::to(removeUnicodeCharacters($participante->email))->queue(new NotificacionRechazoPolitica($politica->nombre_politica));
        }

        return redirect(route('admin.politica-sgsis.index'));
    }

    public function confirmacionAprobacion($proceso, $politica)
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

            $politica->update([
                'estatus' => 'Aprobado',
            ]);

            // dd($proceso, $politica);
            $this->correosAprobacion($proceso->id, $politica);
        } else {
            $this->siguienteCorreo($proceso, $politica);
        }
    }

    public function siguienteCorreo($proceso, $politica)
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
                            Mail::to(removeUnicodeCharacters($emailAprobador))->queue(new NotificacionSolicitudAprobacionPolitica($politica->id, $politica->nombre_politica));
                            break;
                        }
                    }
                }
            }
        }
    }
}
