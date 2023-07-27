<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMinutasaltadireccionRequest;
use App\Http\Requests\StoreMinutasaltadireccionRequest;
use App\Mail\Minutas\MinutaConfirmacionSolicitud;
use App\Mail\Minutas\MinutaRechazoPorEdicion;
use App\Mail\Minutas\SolicitudDeAprobacion;
use App\Models\Empleado;
use App\Models\HistoralRevisionMinuta;
use App\Models\Minutasaltadireccion;
use App\Models\PlanImplementacion;
use App\Models\RevisionMinuta;
use App\Models\Team;
use App\Models\User;
use App\Rules\ActividadesPlanAccionRule;
use App\Rules\ParticipantesMinutasAltaDireccionRule;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MinutasaltadireccionController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('minutasaltadireccion_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $query = Minutasaltadireccion::with(['responsable', 'team', 'participantes', 'planes'])->orderByDesc('id')->get();
            // $table = Datatables::of($query);

            // $table->addColumn('placeholder', '&nbsp;');
            // $table->addColumn('actions', '&nbsp;');

            // $table->editColumn('actions', function ($row) {
            //     $viewGate      = 'minutasaltadireccion_show';
            //     $editGate      = 'minutasaltadireccion_edit';
            //     $deleteGate    = 'minutasaltadireccion_delete';
            //     $crudRoutePart = 'minutasaltadireccions';
            //     $planes = Minutasaltadireccion::find($row->id)->planes;
            //     return view('partials.datatablesActions', compact(
            //         'viewGate',
            //         'editGate',
            //         'deleteGate',
            //         'crudRoutePart',
            //         'row',
            //         'planes',
            //         'revisiones'
            //     ));
            // });

            // $table->editColumn('id', function ($row) {
            //     return $row->id ? $row->id : "";
            // });
            // $table->addColumn('tema_reunion', function ($row) {
            //     return $row->tema_reunion ? $row->tema_reunion : '';
            // });
            // $table->editColumn('fechareunion', function ($row) {
            //     return $row->fechareunion ? $row->fechareunion : "";
            // });
            // $table->addColumn('responsable', function ($row) {
            //     return $row->responsable ? ['name' => $row->responsable->name, 'avatar' => $row->responsable->avatar] : '';
            // });
            // $table->editColumn('participantes', function ($row) {
            //     return $row->participantes ? $row->participantes : "";
            // });
            // $table->editColumn('estatus', function ($row) {
            //     return $row->estatus_formateado ? $row->estatus_formateado : "";
            // });
            // // $table->editColumn('archivo', function ($row) {
            // //     return $row->archivo ? '<a href="' . $row->archivo->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            // // });

            // $table->rawColumns(['actions', 'placeholder', 'responsable', 'archivo']);

            // return $table->make(true);
            return datatables()->of($query)->toJson();
        }

        $users = User::getAll();
        $teams = Team::get();

        return view('frontend.minutasaltadireccions.index', compact('users', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('minutasaltadireccion_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $responsablereunions = Empleado::select('id', 'name', 'foto')->with('area')->get();
        $esta_vinculado = auth()->user()->empleado ? true : false;

        return view('frontend.minutasaltadireccions.create', compact('responsablereunions', 'esta_vinculado'));
    }

    public function store(StoreMinutasaltadireccionRequest $request)
    {
        $request->validate([
            'objetivoreunion' => 'required',
            'responsable_id' => 'required',
            'fechareunion' => 'required',
            'hora_inicio' => 'required',
            'hora_termino' => 'required',
            'tema_reunion' => 'required',
            'tema_tratado' => 'required',
            'actividades' => new ActividadesPlanAccionRule,
            'participantes' => new ParticipantesMinutasAltaDireccionRule,
        ]);

        //Creación Minuta
        $minutasaltadireccion = Minutasaltadireccion::create($request->all());

        if ($request->input('archivo', false)) {
            $minutasaltadireccion->addMedia(storage_path('tmp/uploads/'.$request->input('archivo')))->toMediaCollection('archivo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $minutasaltadireccion->id]);
        }

        //Vinculación Plan de acción
        $this->vincularActividadesPlanDeAccion($request, $minutasaltadireccion);

        // Almacenamiento de participantes relacionados
        $this->vincularParticipantes($request, $minutasaltadireccion);

        //Creación del PDF
        $actividades = json_decode($request->actividades);
        $this->createPDF($minutasaltadireccion, $actividades);

        // Revisiones
        $this->initReviews($minutasaltadireccion);

        return redirect()->route('minutasaltadireccions.index')->with('success', 'Guardado con éxito');
    }

    public function vincularParticipantes($request, $minutasaltadireccion)
    {
        $arrstrParticipantes = explode(',', $request->participantes);
        $participantes = array_map(function ($valor) {
            return intval($valor);
        }, $arrstrParticipantes);
        $minutasaltadireccion->participantes()->sync($participantes);
    }

    public function initReviews($minutasaltadireccion)
    {
        // Almacenamiento de revisiones vinculado a participantes y minutas
        Mail::to($minutasaltadireccion->responsable->email)->send(new MinutaConfirmacionSolicitud($minutasaltadireccion));
        $numero_revision = RevisionMinuta::where('minuta_id', $minutasaltadireccion->id)->max('no_revision') ? intval(RevisionMinuta::where('minuta_id', $minutasaltadireccion->id)->max('no_revision')) + 1 : 1;
        //Historial#
        $historialRevisionMinuta = HistoralRevisionMinuta::create([
            'minuta_id' => $minutasaltadireccion->id,
            'descripcion' => $minutasaltadireccion->objetivoreunion,
            'comentarios' => $minutasaltadireccion->tema_tratado,
            'fecha' => Carbon::now(),
        ]);
        //Revisiones#
        foreach ($minutasaltadireccion->participantes as $participante) {
            $revisor = RevisionMinuta::create([
                'empleado_id' => $participante->id,
                'nivel' => 1,
                'no_revision' => strval($numero_revision),
                'minuta_id' => $minutasaltadireccion->id,
            ]);
            Mail::to($participante->email)->send(new SolicitudDeAprobacion($minutasaltadireccion, $revisor, $historialRevisionMinuta));
        }
    }

    public function vincularActividadesPlanDeAccion($request, $minuta, $planEdit = null, $edit = false)
    {
        if (isset($request->actividades)) {
            $tasks = [
                [
                    'id' => 'tmp_'.(strtotime(now()) * 1000).'_1',
                    'end' => strtotime(now()) * 1000,
                    'name' => 'Minuta - '.$request->tema_reunion,
                    'level' => 0,
                    'start' => strtotime(now()) * 1000,
                    'canAdd' => true,
                    'status' => 'STATUS_ACTIVE',
                    'canWrite' => true,
                    'duration' => 0,
                    'progress' => 0,
                    'canDelete' => true,
                    'collapsed' => false,
                    'relevance' => '0',
                    'canAddIssue' => true,
                    'endIsMilestone' => false,
                    'startIsMilestone' => false,
                    'progressByWorklog' => false,
                    'assigs' => [],
                ],
            ];
            $actividades = json_decode($request->actividades);

            foreach ($actividades as $actividad) {
                $asignados = [];
                if ($edit) {
                    if (gettype($actividad[6]) == 'string') {
                        if (str_contains($actividad[6], ',')) {
                            $asignados = explode(',', $actividad[6]);
                        } else {
                            array_push($asignados, $actividad[6]);
                        }
                    } else {
                        $asignados = $actividad[6];
                    }
                } else {
                    $asignados = $actividad[6];
                }
                $assigs = [];
                foreach ($asignados as $asignado) {
                    $id = intval($asignado);
                    // $empleado = Empleado::find($id);
                    $assigs[] = [
                        'id' => 'tmp_'.time().'_'.$id,
                        'effort' => '0',
                        'roleId' => '1',
                        'resourceId' => $id,
                    ];
                }

                $tasks[] = [
                    'id' => $actividad[0],
                    'end' => strtotime($actividad[3]) * 1000,
                    'name' => $actividad[1],
                    'level' => 1,
                    'start' => strtotime($actividad[2]) * 1000,
                    'canAdd' => true,
                    'status' => 'STATUS_ACTIVE',
                    'canWrite' => true,
                    'duration' => $actividad[4],
                    'progress' => 0,
                    'canDelete' => true,
                    'collapsed' => false,
                    'relevance' => '0',
                    'canAddIssue' => true,
                    'description' => $actividad[7],
                    'endIsMilestone' => false,
                    'startIsMilestone' => false,
                    'progressByWorklog' => false,
                    'assigs' => $assigs,
                ];
            }
            if ($edit) {
                $planEdit->update([
                    'tasks' => $tasks,
                ]);
                $minuta->planes()->sync($planEdit);
            } else {
                $planImplementacion = new PlanImplementacion(); // Necesario se carga inicialmente el Diagrama Universal de Gantt
                $planImplementacion->tasks = $tasks;
                $planImplementacion->canAdd = true;
                $planImplementacion->canWrite = true;
                $planImplementacion->canWriteOnParent = true;
                $planImplementacion->changesReasonWhy = false;
                $planImplementacion->selectedRow = 0;
                $planImplementacion->zoom = '3d';
                $planImplementacion->parent = $request->tema_reunion;
                $planImplementacion->norma = 'ISO 27001';
                $planImplementacion->modulo_origen = 'Minutas Alta Dirección';
                $planImplementacion->objetivo = null;
                $planImplementacion->elaboro_id = auth()->user()->empleado->id;

                $minuta->planes()->save($planImplementacion);
            }
        }
    }

    public function createPDF($minutasaltadireccion, $actividades)
    {
        $actividades = $minutasaltadireccion->planes->first()->tasks;
        $actividades = array_filter($actividades, function ($actividad) {
            return intval($actividad->level) > 0;
        });
        $pdf = \PDF::loadView('frontend.minutasaltadireccions.pdf.minuta-pdf', compact('minutasaltadireccion', 'actividades'));
        Storage::makeDirectory('public/minutas/en aprobacion');
        Storage::makeDirectory('public/minutas/aprobadas');
        $nombre_pdf = Str::limit($minutasaltadireccion->tema_reunion, 20, '').'_'.$minutasaltadireccion->fechareunion.'.pdf';
        $nombre = preg_replace('([^A-Za-z0-9-À-ÿ_.])', '', $nombre_pdf);
        $pdf->save(public_path('storage/minutas/en aprobacion').'/'.$nombre);

        $minutasaltadireccion->documento = $nombre;
        $minutasaltadireccion->save();
    }

    public function edit(Minutasaltadireccion $minutasaltadireccion)
    {
        abort_if(Gate::denies('minutasaltadireccion_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $minutasaltadireccion->load('participantes', 'planes');
        $actividades = $minutasaltadireccion->planes->first()->tasks;
        $actividades = array_filter($actividades, function ($actividad) {
            return intval($actividad->level) > 0;
        });

        $responsablereunions = Empleado::select('id', 'name', 'foto')->get();

        return view('frontend.minutasaltadireccions.edit', compact('responsablereunions', 'minutasaltadireccion', 'actividades'));
    }

    public function processUpdate($request, Minutasaltadireccion $minutasaltadireccion, $edit = false)
    {
        $request->validate([
            'objetivoreunion' => 'required',
            'responsable_id' => 'required',
            'fechareunion' => 'required',
            'hora_inicio' => 'required',
            'hora_termino' => 'required',
            'tema_reunion' => 'required',
            'tema_tratado' => 'required',
            'actividades' => new ActividadesPlanAccionRule,
            'participantes' => new ParticipantesMinutasAltaDireccionRule,
        ]);

        $minuta = $minutasaltadireccion->update($request->all());

        $this->vincularParticipantes($request, $minutasaltadireccion);
        if ($edit) {
            $plan = $minutasaltadireccion->planes->first();
            $this->vincularActividadesPlanDeAccion($request, $minutasaltadireccion, $plan, true);
        } else {
            $this->vincularActividadesPlanDeAccion($request, $minutasaltadireccion);
        }
    }

    public function update(Request $request, Minutasaltadireccion $minutasaltadireccion)
    {
        $this->processUpdate($request, $minutasaltadireccion, true);

        if ($request->input('archivo', false)) {
            if (! $minutasaltadireccion->archivo || $request->input('archivo') !== $minutasaltadireccion->archivo->file_name) {
                if ($minutasaltadireccion->archivo) {
                    $minutasaltadireccion->archivo->delete();
                }

                $minutasaltadireccion->addMedia(storage_path('tmp/uploads/'.$request->input('archivo')))->toMediaCollection('archivo');
            }
        } elseif ($minutasaltadireccion->archivo) {
            $minutasaltadireccion->archivo->delete();
        }

        return redirect()->route('minutasaltadireccions.index')->with('success', 'Editado con éxito');
    }

    public function updateAndReview(Request $request, $minutasaltadireccion)
    {
        $minutasaltadireccion = Minutasaltadireccion::find(intval($minutasaltadireccion));
        $this->processUpdate($request, $minutasaltadireccion, true);
        $ruta_publicacion = 'public/minutas/aprobadas/'.$minutasaltadireccion->documento;

        if (Storage::exists($ruta_publicacion)) {
            Storage::delete($ruta_publicacion);
        }
        //Creación del PDF
        $actividades = json_decode($request->actividades);
        $this->createPDF($minutasaltadireccion, $actividades);

        $this->sendEmailRejectToBeforeReviewers($minutasaltadireccion);
        // Revisiones
        $this->initReviews($minutasaltadireccion);

        return redirect()->route('minutasaltadireccions.index')->with('success', 'Editado con éxito');
    }

    public function sendEmailRejectToBeforeReviewers($minuta)
    {
        $minuta->update([
            'estatus' => Minutasaltadireccion::EN_REVISION,
        ]);
        $revision_actual = intval(RevisionMinuta::where('minuta_id', $minuta->id)->max('no_revision'));

        $revisionesSinReponderAun = RevisionMinuta::where('minuta_id', $minuta->id)->where('no_revision', $revision_actual)->where('estatus', strval(RevisionMinuta::SOLICITUD_REVISION))->get();
        foreach ($revisionesSinReponderAun as $revisionSinResponder) {
            $revisionSinResponder->update([
                'estatus' => RevisionMinuta::RECHAZADO_POR_NUEVA_EDICION,
            ]);
        }

        $revisiones = RevisionMinuta::where('minuta_id', $minuta->id)->where('no_revision', $revision_actual)->get();
        foreach ($revisiones as $revision) {
            $mail = $revision->empleado->email;
            Mail::to($mail)->send(new MinutaRechazoPorEdicion($minuta, $revision));
        }
    }

    public function show(Minutasaltadireccion $minutasaltadireccion)
    {
        abort_if(Gate::denies('minutasaltadireccion_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $minutasaltadireccion->load('responsable', 'team');

        return view('frontend.minutasaltadireccions.show', compact('minutasaltadireccion'));
    }

    public function destroy(Request $request, Minutasaltadireccion $minutasaltadireccion)
    {
        abort_if(Gate::denies('minutasaltadireccion_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $minutasaltadireccion->delete();

            return response()->json(['success', true]);
        }
    }

    public function massDestroy(MassDestroyMinutasaltadireccionRequest $request)
    {
        Minutasaltadireccion::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('minutasaltadireccion_create') && Gate::denies('minutasaltadireccion_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model = new Minutasaltadireccion();
        $model->id = $request->input('crud_id', 0);
        $model->exists = true;
        $media = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    public function renderHistoryReview($minuta)
    {
        $minuta = Minutasaltadireccion::find(intval($minuta));
        $revisiones = RevisionMinuta::with('minuta', 'empleado')->where('minuta_id', $minuta->id)->get();

        return view('frontend.minutasaltadireccions.revisiones.history-reviews', compact('minuta', 'revisiones'));
    }

    public function createPlanAccion(Minutasaltadireccion $id)
    {
        $planImplementacion = new PlanImplementacion();
        $modulo = $id;
        $modulo_name = 'Matríz de Requisitos Legales';
        $referencia = $modulo->nombrerequisito;
        $urlStore = route('matriz-requisito-legales.storePlanAccion', $id);

        return view('frontend.planesDeAccion.create', compact('planImplementacion', 'modulo_name', 'modulo', 'referencia', 'urlStore'));
    }

    public function storePlanAccion(Request $request, Minutasaltadireccion $id)
    {
        $request->validate([
            'parent' => 'required|string',
            'norma' => 'required|string',
            'modulo_origen' => 'required|string',
            'objetivo' => 'required|string',
        ], [
            'parent.required' => 'Debes de definir un nombre para el plan de acción',
            'norma.required' => 'Debes de definir una norma para el plan de acción',
            'modulo_origen.required' => 'Debes de definir un módulo de origen para el plan de acción',
            'objetivo.required' => 'Debes de definir un objetivo para el plan de acción',
        ]);

        $planImplementacion = new PlanImplementacion(); // Necesario se carga inicialmente el Diagrama Universal de Gantt
        $planImplementacion->tasks = [];
        $planImplementacion->canAdd = true;
        $planImplementacion->canWrite = true;
        $planImplementacion->canWriteOnParent = true;
        $planImplementacion->changesReasonWhy = false;
        $planImplementacion->selectedRow = 0;
        $planImplementacion->zoom = '3d';
        $planImplementacion->parent = $request->parent;
        $planImplementacion->norma = $request->norma;
        $planImplementacion->modulo_origen = $request->modulo_origen;
        $planImplementacion->objetivo = $request->objetivo;
        $planImplementacion->elaboro_id = auth()->user()->empleado->id;

        $minuta = $id;
        $minuta->planes()->save($planImplementacion);

        return redirect()->route('minutasaltadireccions.index')->with('success', 'Plan de Acción'.$planImplementacion->parent.' creado');
    }
}
