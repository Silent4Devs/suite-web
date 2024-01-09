<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMinutasaltadireccionRequest;
use App\Mail\Minutas\MinutaConfirmacionSolicitud;
use App\Mail\Minutas\MinutaRechazoPorEdicion;
use App\Mail\Minutas\SolicitudDeAprobacion;
use App\Mail\NotificacionMinutaAprobada;
use App\Mail\NotificacionMinutaRechazada;
use App\Mail\NotificacionMinutaRechazadaResponsable;
use App\Mail\SolicitudAprobacionMinuta;
use App\Models\Empleado;
use App\Models\ExternosMinutaDireccion;
use App\Models\FilesRevisonDireccion;
use App\Models\HistoralRevisionMinuta;
use App\Models\Minutasaltadireccion;
use App\Models\Organizacion;
use App\Models\PlanImplementacion;
use App\Models\RevisionMinuta;
use App\Models\Team;
use App\Models\User;
use App\Rules\ActividadesPlanAccionRule;
use App\Rules\ParticipantesMinutasAltaDireccionRule;
use App\Traits\ObtenerOrganizacion;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use PDF;

class MinutasaltadireccionController extends Controller
{
    use MediaUploadingTrait, ObtenerOrganizacion;

    public function index(Request $request)
    {
        abort_if(Gate::denies('revision_por_direccion_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // if ($request->ajax()) {
        $query = Minutasaltadireccion::getAllMinutasAltaDireccion();

        //     return datatables()->of($query)->toJson();
        // }
        // foreach ($query as $q) {
        //     if ($q->id == 6) {
        //         dd($q->participantes);
        //     }
        // }

        $users = User::getAll();
        //$teams = Team::get();
        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $direccion = $organizacion_actual->direccion;
        $empresa_actual = $organizacion_actual->empresa;
        $rfc = $organizacion_actual->rfc;

        return view('admin.minutasaltadireccions.index', compact('query', 'users', 'organizacion_actual', 'logo_actual', 'empresa_actual', 'direccion', 'rfc'));
    }

    public function create()
    {
        abort_if(Gate::denies('revision_por_direccion_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $responsablereunions = Empleado::alta()->select('id', 'name', 'foto')->with('area')->get();
        $esta_vinculado = User::getCurrentUser()->empleado ? true : false;

        return view('admin.minutasaltadireccions.create', compact('responsablereunions', 'esta_vinculado'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('revision_por_direccion_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            'objetivoreunion' => 'required',
            'responsable_id' => 'required',
            'fechareunion' => 'required',
            'hora_inicio' => 'required',
            'hora_termino' => 'required',
            'tema_reunion' => 'required',
            'tema_tratado' => 'required',
            'tipo_reunion' => 'required',
            'actividades' => new ActividadesPlanAccionRule,
            'participantes' => new ParticipantesMinutasAltaDireccionRule,

        ]);

        $minutasaltadireccion = Minutasaltadireccion::create($request->all());
        // dd('se guardo bien tipo de reunion', $minutasaltadireccion);
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            foreach ($files as $file) {
                if (Storage::putFileAs('public/FilesRevisionDireccion', $file, $file->getClientOriginalName())) {
                    FilesRevisonDireccion::create([
                        'name' => $file->getClientOriginalName(),
                        'revision_id' => $minutasaltadireccion->id,
                    ]);
                }
            }
        }
        //Creación Minuta

        if ($request->input('archivo', false)) {
            $minutasaltadireccion->addMedia(storage_path('tmp/uploads/' . $request->input('archivo')))->toMediaCollection('archivo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $minutasaltadireccion->id]);
        }

        //Vinculación Plan de acción
        $this->vincularActividadesPlanDeAccion($request, $minutasaltadireccion);

        // Almacenamiento de participantes relacionados
        $this->vincularParticipantes($request, $minutasaltadireccion);

        if ($request->has('participantesExt')) {
            $this->vincularParticipantesExternos($request, $minutasaltadireccion);
        }
        //Creación del PDF
        $actividades = json_decode($request->actividades);
        $this->createPDF($minutasaltadireccion, $actividades);

        // // Revisiones
        $this->initReviews($minutasaltadireccion);

        // $this->enviarCorreosParticipantes($minutasaltadireccion);

        return redirect()->route('admin.minutasaltadireccions.index')->with('success', 'Guardado con éxito');
    }

    public function vincularParticipantes($request, $minutasaltadireccion)
    {
        // $arrstrParticipantes = explode(',', $request->participantes);
        // $participantes = array_map(function ($valor) {
        //     return intval($valor);
        // }, $arrstrParticipantes);

        $participantes = json_decode($request->input('participantes'));
        // dd($participantes);
        if (is_array($participantes)) {
            foreach ($participantes as $participante) {

                $empleadoId = $participante->empleado_id;
                $asistencia = $participante->asistencia;

                $arrpart[] = [
                    'empleado_id' => $empleadoId,
                    'asistencia' => $asistencia,
                ];
            }
        }
        // dd($arrpart);
        $minutasaltadireccion->participantes()->sync($arrpart);
        // dd('SE guardo correctamente');
    }

    public function vincularParticipantesExternos($request, $minutasaltadireccion)
    {
        $arrParticipantes = json_decode($request->participantesExt);
        foreach ($arrParticipantes as $participante) {
            $exists = ExternosMinutaDireccion::where('minuta_id', $minutasaltadireccion->id)->where('nombreEXT', $participante->nombre)->where('emailEXT', $participante->email)->where('puestoEXT', $participante->puesto)->where('empresaEXT', $participante->empresa)->first();
            if (!$exists) {
                ExternosMinutaDireccion::create([
                    'nombreEXT' => $participante->nombre,
                    'emailEXT' => removeUnicodeCharacters($participante->email),
                    'puestoEXT' => $participante->puesto,
                    'empresaEXT' => $participante->empresa,
                    'asistenciaEXT' => $participante->asistencia,
                    'minuta_id' => $minutasaltadireccion->id,
                ]);
            }
        }
    }

    public function enviarCorreosParticipantes($minutasaltadireccion)
    {
        $id_minuta = $minutasaltadireccion->id;
        $tema_minuta = $minutasaltadireccion->tema_reunion;
        foreach ($minutasaltadireccion->participantesCorreo as $participante) {
            //Mail::to(removeUnicodeCharacters($participante->email))->send(new SolicitudAprobacionMinuta($id_minuta, $tema_minuta));
        }

        foreach ($minutasaltadireccion->externos as $externo) {
            //Mail::to(removeUnicodeCharacters($externo->emailEXT))->send(new SolicitudAprobacionMinuta($id_minuta, $tema_minuta));
        }
    }

    public function initReviews($minutasaltadireccion)
    {
        // Almacenamiento de revisiones vinculado a participantes y minutas
        // //Mail::to(removeUnicodeCharacters($minutasaltadireccion->responsable->email))->send(new MinutaConfirmacionSolicitud($minutasaltadireccion));
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
            // //Mail::to(removeUnicodeCharacters($participante->email))->send(new SolicitudDeAprobacion($minutasaltadireccion, $revisor, $historialRevisionMinuta));
        }

        $this->enviarCorreosParticipantes($minutasaltadireccion);
    }

    public function vincularActividadesPlanDeAccion($request, $minuta, $planEdit = null, $edit = false)
    {
        if (isset($request->actividades)) {
            $tasks = [
                [
                    'id' => 'tmp_' . (strtotime(now()) * 1000) . '_1',
                    'end' => strtotime(now()) * 1000,
                    'name' => 'Minuta - ' . $request->tema_reunion,
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
                    if (gettype($actividad[7]) == 'string') {
                        if (str_contains($actividad[7], ',')) {
                            $asignados = explode(',', $actividad[7]);
                        } else {
                            array_push($asignados, $actividad[7]);
                        }
                    } else {
                        $asignados = $actividad[7];
                    }
                } else {
                    $asignados = $actividad[7];
                }
                $assigs = [];
                foreach ($asignados as $asignado) {
                    $id = intval($asignado);
                    // $empleado = Empleado::find($id);
                    $assigs[] = [
                        'id' => 'tmp_' . time() . '_' . $id,
                        'effort' => '0',
                        'roleId' => '1',
                        'resourceId' => $id,
                    ];
                }

                $tasks[] = [
                    'id' => $actividad[0],
                    'end' => strtotime($actividad[4]) * 1000,
                    'name' => $actividad[2],
                    'level' => 1,
                    'start' => strtotime($actividad[3]) * 1000,
                    'canAdd' => true,
                    'status' => 'STATUS_ACTIVE',
                    'canWrite' => true,
                    'duration' => $actividad[5],
                    'progress' => 0,
                    'canDelete' => true,
                    'collapsed' => false,
                    'relevance' => '0',
                    'canAddIssue' => true,
                    'description' => $actividad[8],
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
                $planImplementacion->elaboro_id = User::getCurrentUser()->empleado->id;

                $minuta->planes()->save($planImplementacion);
            }
        }
    }

    public function createPDF($minutasaltadireccion, $actividades)
    {
        $participantesWithAsistencia = $minutasaltadireccion->participantes()
            ->withPivot('asistencia')
            ->get();
        $actividades = $minutasaltadireccion->planes->first()->tasks;
        $actividades = array_filter($actividades, function ($actividad) {
            return intval($actividad->level) > 0;
        });
        $pdf = \PDF::loadView('admin.minutasaltadireccions.pdf.minuta-pdf', compact('minutasaltadireccion', 'actividades', 'participantesWithAsistencia'));
        Storage::makeDirectory('public/minutas/en aprobacion');
        Storage::makeDirectory('public/minutas/aprobadas');
        $nombre_pdf = Str::limit($minutasaltadireccion->tema_reunion, 20, '') . '_' . $minutasaltadireccion->fechareunion . '.pdf';
        $nombre = preg_replace('([^A-Za-z0-9-À-ÿ_.])', '', $nombre_pdf);
        $pdf->save(public_path('storage/minutas/en aprobacion') . '/' . $nombre);

        $minutasaltadireccion->documento = $nombre;
        $minutasaltadireccion->save();
    }

    public function edit($id)
    {
        abort_if(Gate::denies('revision_por_direccion_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $minutasaltadireccion = Minutasaltadireccion::find($id);
        $minutasaltadireccion->load('participantes', 'planes', 'documentos', 'externos');
        $actividades = $minutasaltadireccion->planes->first()->tasks;
        $actividades = array_filter($actividades, function ($actividad) {
            return intval($actividad->level) > 0;
        });

        $participantesWithAsistencia = $minutasaltadireccion->participantes()
            ->withPivot('asistencia')
            ->get();
        // dd($participantesWithAsistencia);

        $responsablereunions = Empleado::getaltaAll();

        return view('admin.minutasaltadireccions.edit', compact(
            'minutasaltadireccion',
            'actividades',
            'participantesWithAsistencia',
            'responsablereunions'
        ));
    }

    public function processUpdate($request, Minutasaltadireccion $minutasaltadireccion, $edit = false)
    {
        $request->validate([
            'objetivoreunion' => 'required',
            'responsable_id' => 'required',
            'fechareunion' => 'required',
            'tipo_reunion' => 'required',
            'hora_inicio' => 'required',
            'hora_termino' => 'required',
            'tema_reunion' => 'required',
            'tema_tratado' => 'required',
            'actividades' => new ActividadesPlanAccionRule,
            'participantes' => new ParticipantesMinutasAltaDireccionRule,
        ]);

        $minuta = $minutasaltadireccion->update($request->all());

        $this->vincularParticipantes($request, $minutasaltadireccion);
        if ($request->has('participantesExt')) {
            $this->vincularParticipantesExternos($request, $minutasaltadireccion);
        }
        if ($edit) {
            $plan = $minutasaltadireccion->planes->first();
            $this->vincularActividadesPlanDeAccion($request, $minutasaltadireccion, $plan, true);
        } else {
            $this->vincularActividadesPlanDeAccion($request, $minutasaltadireccion);
        }
    }

    public function update(Request $request, Minutasaltadireccion $minutasaltadireccion)
    {
        abort_if(Gate::denies('revision_por_direccion_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $this->processUpdate($request, $minutasaltadireccion, true);
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            foreach ($files as $file) {
                if (Storage::putFileAs('public/FilesRevisionDireccion', $file, $file->getClientOriginalName())) {
                    FilesRevisonDireccion::create([
                        'name' => $file->getClientOriginalName(),
                        'revision_id' => $minutasaltadireccion->id,
                    ]);
                }
            }
        }

        if ($request->input('archivo', false)) {
            if (!$minutasaltadireccion->archivo || $request->input('archivo') !== $minutasaltadireccion->archivo->file_name) {
                if ($minutasaltadireccion->archivo) {
                    $minutasaltadireccion->archivo->delete();
                }

                $minutasaltadireccion->addMedia(storage_path('tmp/uploads/' . $request->input('archivo')))->toMediaCollection('archivo');
            }
        } elseif ($minutasaltadireccion->archivo) {
            $minutasaltadireccion->archivo->delete();
        }

        return redirect()->route('admin.minutasaltadireccions.index')->with('success', 'Editado con éxito');
    }

    public function updateAndReview(Request $request, $minutasaltadireccion)
    {
        $minutasaltadireccion = Minutasaltadireccion::find(intval($minutasaltadireccion));
        $this->processUpdate($request, $minutasaltadireccion, true);
        $ruta_publicacion = 'public/minutas/aprobadas/' . $minutasaltadireccion->documento;

        if (Storage::exists($ruta_publicacion)) {
            Storage::delete($ruta_publicacion);
        }
        //Creación del PDF
        $actividades = json_decode($request->actividades);
        $this->createPDF($minutasaltadireccion, $actividades);

        $this->sendEmailRejectToBeforeReviewers($minutasaltadireccion);
        // Revisiones
        $this->initReviews($minutasaltadireccion);

        return redirect()->route('admin.minutasaltadireccions.index')->with('success', 'Editado con éxito');
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
            //Mail::to(removeUnicodeCharacters($mail))->send(new MinutaRechazoPorEdicion($minuta, $revision));
        }
    }

    public function show($id)
    {

        abort_if(Gate::denies('revision_por_direccion_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $minutas = Minutasaltadireccion::with('responsable')->find($id);
        $responsable = Empleado::where('id',  $minutas->responsable_id)->first();
        $revision = RevisionMinuta::where('id',  $minutas->id)->first();
        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $direccion = $organizacion_actual->direccion;
        $empresa_actual = $organizacion_actual->empresa;
        $rfc = $organizacion_actual->rfc;

        return view('admin.minutasaltadireccions.revision', compact('minutas', 'logo_actual', 'direccion', 'empresa_actual', 'rfc', 'responsable', 'revision'));
    }

    public function aprobado($id, Request $request)
    {
        // dd($id);
        $revision_actual = intval(RevisionMinuta::where('minuta_id', $id)->max('no_revision'));
        $aprobacion = RevisionMinuta::where('minuta_id', '=', $id)->where('empleado_id', '=', User::getCurrentUser()->empleado->id)
            ->where('no_revision', '=', $revision_actual)->first();
        // dd($aprobacion);
        $aprobacion->update([
            'estatus' => RevisionMinuta::APROBADO,
            'comentarios' => $request->comentario,
        ]);

        $this->confirmacionAprobacion($id, $revision_actual);

        return redirect(route('admin.minutasaltadireccions.index'));
    }

    public function rechazado($id, Request $request)
    {
        // dd($id, $request->all());
        $revision_actual = intval(RevisionMinuta::where('minuta_id', $id)->max('no_revision'));
        $aprobacion = RevisionMinuta::where('minuta_id', '=', $id)->where('empleado_id', '=', User::getCurrentUser()->empleado->id)
            ->where('no_revision', '=', $revision_actual)->first();
        // dd($aprobacion);
        $aprobacion->update([
            'estatus' => RevisionMinuta::RECHAZADO,
            'comentarios' => $request->comentario,
        ]);

        $minuta = Minutasaltadireccion::find($id);

        $minuta->update([
            'estatus' => Minutasaltadireccion::DOCUMENTO_RECHAZADO,
        ]);
        // $responsable = $minuta->responsable->name;
        $emailresponsable = $minuta->responsable->email;
        $tema_minuta = $minuta->tema_reunion;

        //Mail::to(removeUnicodeCharacters($emailresponsable))->send(new NotificacionMinutaRechazadaResponsable($minuta->id, $tema_minuta, User::getCurrentUser()->empleado->name));

        foreach ($minuta->participantes as $participante) {

            //Mail::to(removeUnicodeCharacters($participante->email))->send(new NotificacionMinutaRechazada($tema_minuta));
        }

        return redirect(route('admin.minutasaltadireccions.index'));
    }

    public function confirmacionAprobacion($id, $revision_actual)
    {
        $confirmacion = RevisionMinuta::where('minuta_id', '=', $id)
            ->where('no_revision', '=', $revision_actual)
            ->get();

        $isSameEstatus = $confirmacion->every(function ($record) {
            return $record->estatus == 2; // Assuming 'estatus' is the column name
        });
        // dd($confirmacion, $isSameEstatus);
        if ($isSameEstatus) {
            $minuta = Minutasaltadireccion::find($id);
            $responsable = $minuta->responsable->name;
            $emailresponsable = $minuta->responsable->email;
            $tema_minuta = $minuta->tema_reunion;
            // All records in $confirmacion have 'estatus' equal to 2
            //Mail::to(removeUnicodeCharacters($emailresponsable))->send(new NotificacionMinutaAprobada($responsable, $tema_minuta));
            $minuta->update([
                'estatus' => Minutasaltadireccion::PUBLICADO,
            ]);

            $fileToCopy = 'storage/minutas/en aprobacion' . '/' . $minuta->documento;
            $destinationFolder = 'storage/minutas/aprobadas'; // Replace this with the destination folder path

            // Check if the source file exists
            if (File::exists($fileToCopy)) {
                $fileName = pathinfo($fileToCopy, PATHINFO_BASENAME); // Get the filename
                $destinationPath = $destinationFolder . '/' . $fileName; // Create the destination path

                File::copy($fileToCopy, $destinationPath);
            }
        }
        // else {
        //     // There are records with different 'estatus' values
        // }
    }

    public function destroy(Request $request, Minutasaltadireccion $minutasaltadireccion)
    {
        abort_if(Gate::denies('revision_por_direccion_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
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

        return view('admin.minutasaltadireccions.revisiones.history-reviews', compact('minuta', 'revisiones'));
    }

    public function createPlanAccion(Minutasaltadireccion $id)
    {
        $planImplementacion = new PlanImplementacion();
        $modulo = $id;
        $modulo_name = 'Matríz de Requisitos Legales';
        $referencia = $modulo->nombrerequisito;
        $urlStore = route('admin.matriz-requisito-legales.storePlanAccion', $id);

        return view('admin.planesDeAccion.create', compact('planImplementacion', 'modulo_name', 'modulo', 'referencia', 'urlStore'));
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
        $planImplementacion->elaboro_id = User::getCurrentUser()->empleado->id;

        $minuta = $id;
        $minuta->planes()->save($planImplementacion);

        return redirect()->route('admin.minutasaltadireccions.index')->with('success', 'Plan de Acción' . $planImplementacion->parent . ' creado');
    }

    public function pdf($id)
    {
        $minutas = Minutasaltadireccion::where('id', $id)->first();
        $organizacions = Organizacion::getFirst();
        $responsable = Empleado::where('id',  $minutas->responsable_id)->first();
        $revision = RevisionMinuta::where('id',  $minutas->id)->first();
        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $direccion = $organizacion_actual->direccion;
        $empresa_actual = $organizacion_actual->empresa;
        $rfc = $organizacion_actual->rfc;

        $pdf = PDF::loadView('minuta', compact('minutas', 'logo_actual', 'direccion', 'empresa_actual', 'rfc', 'responsable', 'revision'));
        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('minuta.pdf');
    }
}
