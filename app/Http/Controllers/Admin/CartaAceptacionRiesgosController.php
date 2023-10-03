<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Empleado;
use Illuminate\Http\Request;
use App\Models\CartaAceptacion;
use App\Mail\CartaAceptacionEmail;
use App\Http\Controllers\Controller;
use App\Models\CartaAceptacionPivot;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Models\DeclaracionAplicabilidad;
use Yajra\DataTables\Facades\DataTables;
use App\Models\CartaAceptacionAprobacione;
use App\Models\ActivosInformacionAprobacione;

class CartaAceptacionRiesgosController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = CartaAceptacion::get();
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'analisis_de_riesgos_vulnerabilidades_edit';
                $editGate = 'analisis_de_riesgos_vulnerabilidades_show';
                $deleteGate = 'analisis_de_riesgos_vulnerabilidades_delete';
                $crudRoutePart = 'carta-aceptacion';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            // $table->editColumn('id', function ($row) {
            //     return $row->id ? $row->id : '';
            // });
            $table->editColumn('riesgo', function ($row) {
                return $row->folio_riesgo ? $row->folio_riesgo : '';
            });
            $table->editColumn('fecharegistro', function ($row) {
                return $row->fecharegistro ? $row->fecharegistro : '';
            });

            $table->editColumn('fechaaprobacion', function ($row) {
                return $row->fechaaprobacion ? $row->fechaaprobacion : '';
            });

            $table->editColumn('responsables', function ($row) {
                return $row->responsables ? $row->responsables->name : '';
            });

            $table->editColumn('activo_folio', function ($row) {
                return $row->activo_folio ? $row->activo_folio : '';
            });

            $table->editColumn('nombre_activo', function ($row) {
                return $row->nombre_activo ? $row->nombre_activo : '';
            });

            $table->editColumn('criticidad_activo', function ($row) {
                return $row->criticidad_activo ? $row->criticidad_activo : '';
            });

            $table->editColumn('confidencialidad', function ($row) {
                return $row->confidencialidad ? $row->confidencialidad : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.CartaAceptacionRiesgos.index');
    }

    public function create(Request $request)
    {
        $responsables = Empleado::getaltaAll();
        $directoresRiesgo = $responsables;
        $presidencias = $responsables;
        $vicepresidentesOperaciones = $responsables;
        $vicepresidentes = $responsables;
        $controles = DeclaracionAplicabilidad::getAll();

        return view('admin.CartaAceptacionRiesgos.create', compact('controles', 'vicepresidentes', 'vicepresidentesOperaciones', 'presidencias', 'directoresRiesgo', 'responsables'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'responsable_id' => 'required',
            'director_resp_id' => 'required',
            'vp_responsable_id' => 'required',
            'vice_operaciones_id' => 'required',
            'presidencia_id' => 'required',
            'folio_riesgo' => 'required',
            'fecharegistro' => 'required',
            'proceso_id' => 'required',
            'descripcion_negocio' => 'required',
            'descripcion_riesgo' => 'required',
            'descripcion_tecnologico' => 'required',
            'aceptacion_riesgo' => 'required',

        ]);

        $cartaAceptacion = CartaAceptacion::create([
            'folio_riesgo' => $request->folio_riesgo,
            'fecharegistro' => $request->fecharegistro,
            'fechaaprobacion' => $request->fechaaprobacion,
            'responsable_id' => $request->responsable_id,
            'activo_folio' => $request->activo_folio,
            'nombre_activo' => $request->nombre_activo,
            'criticidad_activo' => $request->criticidad_activo,
            'confidencialidad' => $request->confidencialidad,
            'descripcion_negocio' => $request->descripcion_negocio,
            'descripcion_riesgo' => $request->descripcion_riesgo,
            'descripcion_tecnologico' => $request->descripcion_tecnologico,
            'legal' => $request->legal,
            'cumplimiento' => $request->cumplimiento,
            'reputacional' => $request->reputacional,
            'operacional' => $request->operacional,
            'financiero' => $request->financiero,
            'tecnologico' => $request->tecnologico,
            'aceptacion_riesgo' => $request->aceptacion_riesgo,
            'hallazgo' => $request->hallazgo,
            'controles_compensatorios' => $request->controles_compensatorios,
            'recomendaciones' => $request->recomendaciones,
            'controles_id' => $request->controles_id,
            'director_resp_id' => $request->director_resp_id,
            'fecha_aut_direct' => $request->fecha_aut_direct,
            'vp_responsable_id' => $request->vp_responsable_id,
            'fecha_vp_aut' => $request->fecha_vp_aut,
            'presidencia_id' => $request->presidencia_id,
            'fecha_aut_presidencia' => $request->fecha_aut_presidencia,
            'vice_operaciones_id' => $request->vice_operaciones_id,
            'fecha_aut_viceoperaciones' => $request->fecha_aut_viceoperaciones,
            'proceso_id' => $request->proceso_id,
            'hallazgos_auditoria' => $request->hallazgos_auditoria,
        ]);

        foreach ($request->controles_id as $item) {
            $control = new CartaAceptacionPivot();
            $control->carta_id = $cartaAceptacion->id;
            $control->controles_id = $item;
            $control->save();
        }

        $this->enviarCorreos($request, $cartaAceptacion);
        // // dd($request->all());

        return redirect(route('admin.carta-aceptacion.index'));
    }

    public function update(Request $request, CartaAceptacion $cartaAceptacion)
    {
        $cartaAceptacion->update($request->all());
        // $cartaAceptacion = CartaAceptacion::create($request->all());

        return redirect(route('admin.carta-aceptacion.index'));
    }

    public function edit($cartaAceptacion)
    {
        $cartaAceptacion = CartaAceptacion::find($cartaAceptacion);
        $responsables = Empleado::getaltaAll();
        $directoresRiesgo = $responsables;
        $presidencias = $responsables;
        $vicepresidentesOperaciones = $responsables;
        $vicepresidentes = $responsables;
        $controles = DeclaracionAplicabilidad::getAll();

        return view('admin.CartaAceptacionRiesgos.edit', compact('cartaAceptacion', 'controles', 'vicepresidentes', 'vicepresidentesOperaciones', 'presidencias', 'directoresRiesgo', 'responsables'));
    }

    public function show($cartaAceptacion)
    {
        $user = User::getCurrentUser();
        // $controles =DeclaracionAplicabilidad::where('carta_id','=',$cartaAceptacion->id)->get();
        $cartaAceptacion = CartaAceptacion::with(['aprobaciones' => function ($query) {
            $query->with('empleado', 'aprobacionesActivo')->orderBy('nivel');
        }])->find($cartaAceptacion);
        $responsables = Empleado::getaltaAll();
        $directoresRiesgo = $responsables;
        $presidencias = $responsables;
        $vicepresidentesOperaciones = $responsables;
        $vicepresidentes = $responsables;
        $controles = CartaAceptacionPivot::with('declaracion_aplicabilidad')->where('carta_id', $cartaAceptacion->id)->get();
        // dd($controles);
        $aprobadores = CartaAceptacionAprobacione::where('carta_id', $cartaAceptacion->id)->pluck('aprobador_id')->toArray();
        // dd($aprobadores);
        $esAprobador = in_array($user->empleado->id, $aprobadores);
        $miAprobacion = $cartaAceptacion->aprobaciones->filter(function ($item) use ($user) {
            return $item->aprobador_id == $user->empleado->id;
        });
        $route = 'storage/cartasAceptacion/firmas/' . preg_replace(['/\s+/i', '/-/i'], '_', $cartaAceptacion->id) . '/';
        // dd($cartaAceptacion->aprobaciones);
        $aprobadores = $cartaAceptacion->aprobaciones;

        return view('admin.CartaAceptacionRiesgos.show', compact('aprobadores', 'route', 'miAprobacion', 'esAprobador', 'aprobadores', 'cartaAceptacion', 'controles', 'vicepresidentes', 'vicepresidentesOperaciones', 'presidencias', 'directoresRiesgo', 'responsables'));
    }

    public function destroy(CartaAceptacion $cartaAceptacion)
    {
        $cartaAceptacion->delete();

        return back();
    }

    public function enviarCorreos($request, $cartaAceptacion)
    {
        CartaAceptacionAprobacione::create([
            'autoridad' => 'Dueño del Riesgo',
            'aprobador_id' => $request->responsable_id,
            'carta_id' => $cartaAceptacion->id,
            'nivel' => 1,
        ]);
        $dueno = Empleado::select('id', 'name', 'email', 'genero', 'foto')->find($request->responsable_id);
        Mail::to(removeUnicodeCharacters($dueno->email))->send(new CartaAceptacionEmail($dueno, $cartaAceptacion));

        CartaAceptacionAprobacione::create([
            'autoridad' => 'Director Responsable del Riesgo',
            'aprobador_id' => $request->director_resp_id,
            'carta_id' => $cartaAceptacion->id,
            'nivel' => 2,
        ]);

        CartaAceptacionAprobacione::create([
            'autoridad' => 'VP Responsable del Riesgo',
            'aprobador_id' => $request->vp_responsable_id,
            'carta_id' => $cartaAceptacion->id,
            'nivel' => 3,
        ]);

        CartaAceptacionAprobacione::create([
            'autoridad' => 'VP de Operaciones',
            'aprobador_id' => $request->vice_operaciones_id,
            'carta_id' => $cartaAceptacion->id,
            'nivel' => 4,
        ]);

        CartaAceptacionAprobacione::create([
            'autoridad' => 'Presidencia',
            'aprobador_id' => $request->presidencia_id,
            'carta_id' => $cartaAceptacion->id,
            'nivel' => 5,
        ]);
    }

    public function aprobacionAutoridad(Request $request)
    {
        $usuario = User::getCurrentUser();
        $cartaAceptacion = CartaAceptacionAprobacione::where('aprobador_id', $usuario->empleado->id)->where('autoridad', $request->autoridad)->first();
        $existsFolderFirmasCartas = Storage::exists('public/cartasAceptacion/firmas/' . preg_replace(['/\s+/i', '/-/i'], '_', $cartaAceptacion->carta_id));
        if (!$existsFolderFirmasCartas) {
            Storage::makeDirectory('public/cartasAceptacion/firmas/' . preg_replace(['/\s+/i', '/-/i'], '_', $cartaAceptacion->carta_id));
        }

        if (isset($request->firma)) {
            if (preg_match('/^data:image\/(\w+);base64,/', $request->firma)) {
                $value = substr($request->firma, strpos($request->firma, ',') + 1);
                $value = base64_decode($value);
                $new_name_image = 'FirmaAutoridad' . $cartaAceptacion->carta_id . $usuario->empleado->id . time() . '.png';
                $image = $new_name_image;
                $route = 'public/cartasAceptacion/firmas/' . preg_replace(['/\s+/i', '/-/i'], '_', $cartaAceptacion->carta_id) . '/' . $new_name_image;
                Storage::put($route, $value);
                $cartaAceptacion->update([
                    'comentarios' => $request->comentarios,
                    'firma' => $image,
                    'estado' => 1,
                    'fecha_aprobacion' => Carbon::now(),
                ]);
            }
            $activos = json_decode($request->activos, true);
            foreach ($activos as $activo) {
                $aceptado = $activo['aceptado'] == 'true' ? true : false;
                $activoId = $activo['id'];
                ActivosInformacionAprobacione::create([
                    'aceptado' => $aceptado,
                    'persona_califico_id' => $usuario->empleado->id,
                    'activoInformacion_id' => $activoId,
                    'carta_aceptacion_aprobacion_id' => $cartaAceptacion->id,
                ]);
            }

            $cartaAceptacionModel = CartaAceptacion::with(['proceso' => function ($q) {
                $q->with(['proceso' => function ($q) {
                    $q->with('activosAI');
                }]);
            }, 'aprobaciones' => function ($query) {
                $query->with('empleado', 'aprobacionesActivo')->orderBy('nivel');
            }])->find($cartaAceptacion->carta_id);

            $aprobadores = $cartaAceptacionModel->aprobaciones;
            $activosRechazados = [];
            foreach ($cartaAceptacionModel->proceso->proceso->activosAI as $activo) {
                foreach ($aprobadores as $aprobador) {
                    foreach ($aprobador->aprobacionesActivo as $aprobacionActivo) {
                        if ($activo->id == $aprobacionActivo->activoInformacion_id) {
                            if (!$aprobacionActivo->aceptado) {
                                array_push($activosRechazados, false);
                            }
                        }
                    }
                }
            }

            $rechazado = $cartaAceptacionModel->proceso->proceso->activosAI->count() == count($activosRechazados);
            if (!$rechazado) {
                $siguienteNivel = $cartaAceptacion->nivel + 1;
                $siguienteCarta = CartaAceptacionAprobacione::where('carta_id', $cartaAceptacion->carta_id)->where('nivel', $siguienteNivel)->first();
                if ($siguienteCarta) {
                    $empleado = Empleado::select('id', 'name', 'email', 'genero', 'foto')->find($siguienteCarta->aprobador_id);
                    $carta = CartaAceptacion::find($cartaAceptacion->carta_id);
                    Mail::to(removeUnicodeCharacters($empleado->email))->send(new CartaAceptacionEmail($empleado, $carta));
                } else {
                    $cartaAceptacionModel->update([
                        'aceptado' => true,
                        'fechaaprobacion' => Carbon::now(),

                    ]);
                }
            } else {
                $cartaAceptacionModel->update([
                    'aceptado' => false,
                    'fechaaprobacion' => Carbon::now(),

                ]);
            }
        }

        return response()->json(['status' => 200]);
    }
}
