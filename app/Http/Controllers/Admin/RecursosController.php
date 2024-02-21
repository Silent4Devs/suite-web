<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyRecursoRequest;
use App\Mail\CapacitacionCanceladaMail;
use App\Mail\CapacitacionReprogramadaMail;
use App\Mail\ElearningInscripcionMail;
use App\Mail\InvitacionCapacitaciones;
use App\Models\Area;
use App\Models\CategoriaCapacitacion;
use App\Models\Empleado;
use App\Models\FileCapacitacion;
use App\Models\Recurso;
use App\Models\RH\GruposEvaluado;
use App\Models\Team;
use App\Models\User;
use App\Traits\ObtenerOrganizacion;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class RecursosController extends Controller
{
    use MediaUploadingTrait, ObtenerOrganizacion;

    public function index(Request $request)
    {
        abort_if(Gate::denies('capacitaciones_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Recurso::with([
                'empleados:id,name,foto,puesto',
                'team',
                'categoria_capacitacion',
            ])->select(sprintf('%s.*', (new Recurso)->table))
                ->orderByDesc('id');

            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->addIndexColumn();
            $table->editColumn('actions', function ($row) {
                $viewGate = 'capacitaciones_ver';
                $editGate = 'capacitaciones_editar';
                $deleteGate = 'capacitaciones_eliminar';
                $crudRoutePart = 'recursos';

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
            $table->editColumn('cursoscapacitaciones', function ($row) {
                return $row->cursoscapacitaciones ? $row->cursoscapacitaciones : '';
            });

            $table->editColumn('participantes', function ($row) {
                return $row->empleados ? $row->empleados : '';
            });
            $table->editColumn('instructor', function ($row) {
                return $row->instructor ? $row->instructor : '';
            });
            $table->editColumn('certificado', function ($row) {
                if (! $row->certificado) {
                    return '';
                }

                $links = [];

                foreach ($row->certificado as $media) {
                    $links[] = '<a href="'.$media->getUrl().'" target="_blank">'.trans('global.downloadFile').'</a>';
                }

                return implode(', ', $links);
            });

            $table->rawColumns(['actions', 'placeholder', 'participantes', 'certificado']);

            return $table->make(true);
        }

        $users = User::getAll();
        $teams = Team::get();
        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.recursos.index', compact('users', 'teams', 'organizacion_actual', 'logo_actual', 'empresa_actual'));
    }

    public function create()
    {
        abort_if(Gate::denies('capacitaciones_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $categorias = CategoriaCapacitacion::getAll();
        $recurso = new Recurso;
        $areas = Area::getWithEmpleados();
        $grupos = GruposEvaluado::getAllWithEmpleado();
        $empleados = Empleado::getaltaAll();

        return view('admin.recursos.create', compact('recurso', 'categorias', 'areas', 'grupos', 'empleados'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('capacitaciones_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->merge([
            'tipo_seleccion_participantes' => [
                'tipo' => $request->tipo_de_grupo,
                'tipo_id' => $request->id_tipo_participacion,
            ],
        ]);
        $this->validateForm($request);
        $request->validate([
            'fecha_limite' => 'date|required|before_or_equal:fecha_curso',
        ]);
        if ($request->enviarInvitacionAhora == 'programar') {
            $limit_date = Carbon::parse($request->fecha_limite)->addDays(5);
            $limit_date->toDateString();
            $request->validate([
                'fecha_envio_invitacion' => 'required|date|before:'.$limit_date,
            ]);
        }
        $request->merge(
            [
                'configuracion_invitacion_envio' => [
                    'enviar_ahora' => $request->enviarInvitacionAhora == 'ahora' ? true : false,
                    'programar_envio' => $request->enviarInvitacionAhora == 'programar' ? true : false, 'fecha_envio_invitacion' => $request->enviarInvitacionAhora == 'programar' ? $request->fecha_envio_invitacion : Carbon::parse(Carbon::now())->format('Y-m-d\TH:i'),
                ],
            ]
        );
        $estatus = $request->tipo_guardado;
        if ($request->enviarInvitacionAhora == 'programar') {
            $estatus = 'Programado';
        }

        if ($request->isElearning) {
            if ($request->estatus == 'Enviado') {
                $empleados = Empleado::getaltaAll()->find($request->participantes)->toArray();
                $emails = Http::post(env('APP_ELEARNING').'/api/users', [
                    'students' => json_encode($empleados),
                    'course' => $request->cursoscapacitaciones,
                ]);
                foreach ($emails->json() as $email) {
                    $empleado = Empleado::getaltaAll()->where('email', $email['email'])->first();
                    Mail::to(removeUnicodeCharacters($empleado->email))->queue(new ElearningInscripcionMail($empleado));
                }
            }
        }

        $duracion = Carbon::parse($request->fecha_curso)->diffInHours(Carbon::parse($request->fecha_fin));
        // dd($request->all());
        $recurso = Recurso::create([
            'cursoscapacitaciones' => $request->cursoscapacitaciones,
            'tipo' => $request->tipo,
            'categoria_capacitacion_id' => $request->categoria_capacitacion_id,
            'fecha_curso' => $request->fecha_curso,
            'fecha_fin' => $request->fecha_fin,
            'duracion' => $duracion,
            'instructor' => $request->instructor,
            'descripcion' => $request->descripcion,
            'modalidad' => $request->modalidad,
            'ubicacion' => $request->ubicacion,
            'fecha_limite' => $request->fecha_limite,
            'tipo_seleccion_participantes' => $request->tipo_seleccion_participantes,
            'configuracion_invitacion_envio' => $request->configuracion_invitacion_envio,
            'estatus' => $estatus,
            'is_sync_elearning' => $request->isElearning ? $request->isElearning : false,
        ]);

        if ($request->file('recurso_capacitacion')) {
            $filenameWithExt = $request->file('recurso_capacitacion')->getClientOriginalName();
            $folder = "{$recurso->id}_recurso";
            Storage::disk('capacitaciones')->putFileAs("recursos/{$folder}", $request->file('recurso_capacitacion'), $filenameWithExt);
            FileCapacitacion::create([
                'archivo' => $filenameWithExt,
                'recurso_id' => $recurso->id,
            ]);
        }

        if ($request->tipo_request == 'ajax') {
            return response()->json(['status' => 'success', 'message' => 'Recurso creado']);
        }

        return redirect()->route('admin.recursos.index')->with('success', 'Guardado con éxito');
    }

    public function validateForm(Request $request)
    {
        if ($request->tipo_validacion == 'general') {
            $this->validateRequestGeneral($request);

            return response()->json(['isValid' => true]);
        } elseif ($request->tipo_validacion == 'lecciones') {
            $this->validateRequestGeneral($request);
            $this->validateRequestLecciones($request);

            return response()->json(['isValid' => true]);
        } elseif ($request->tipo_validacion == 'participantes') {
            $this->validateRequestGeneral($request);
            $this->validateRequestLecciones($request);
            $this->validateRequestParticipantes($request);

            return response()->json(['isValid' => true]);
        } else {
            $this->validateRequestGeneral($request);
            $this->validateRequestParticipantes($request);

            return response()->json(['isValid' => true]);
        }
    }

    public function validateRequestGeneral($request)
    {
        $request->validate([
            'tipo' => 'required',
            'fecha_curso' => 'date|required',
            'fecha_fin' => 'date|required|after:fecha_curso',
            'instructor' => 'string|required',
            'cursoscapacitaciones' => 'required|max:255',
            'modalidad' => 'string|required',
            'ubicacion' => 'string|required',
            'categoria_capacitacion_id' => 'string|required',
            'modalidad' => 'string|required',
            'recurso_capacitacion' => 'nullable|mimes:pdf|max:10000',
        ], [
            'cursoscapacitaciones.required' => 'El titulo de la capacitación es requerido',
        ]);
    }

    public function validateRequestParticipantes($request)
    {
        if ($request->tipo_guardado != 'Borrador') {
            $request->validate([
                'tipo_de_grupo' => 'required',
                'participantes' => 'required',
            ]);
        }
    }

    public function validateRequestLecciones($request)
    {
        if ($request->tipo_guardado != 'Borrador') {
            $request->validate([
                'lecciones.*' => 'required',
            ]);
        }
    }

    public function edit(Recurso $recurso)
    {
        abort_if(Gate::denies('capacitaciones_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $categorias = CategoriaCapacitacion::getAll();
        $areas = Area::getWithEmpleados();
        $grupos = GruposEvaluado::getAllWithEmpleado();
        $empleados = Empleado::getaltaAll();

        return view('admin.recursos.edit', compact('recurso', 'categorias', 'areas', 'grupos', 'empleados'));
    }

    public function update(Request $request, Recurso $recurso)
    {
        abort_if(Gate::denies('capacitaciones_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->merge([
            'tipo_seleccion_participantes' => [
                'tipo' => $request->tipo_de_grupo,
                'tipo_id' => $request->id_tipo_participacion,
            ],
        ]);
        $this->validateForm($request);
        $request->validate([
            'fecha_limite' => 'date|required|before_or_equal:fecha_curso',
        ]);
        if ($request->enviarInvitacionAhora == 'programar') {
            $limit_date = Carbon::parse($request->fecha_limite)->addDays(5);
            $limit_date->toDateString();
            $request->validate([
                'fecha_envio_invitacion' => 'required|date|before:'.$limit_date,
            ]);
        }
        $request->merge(
            [
                'configuracion_invitacion_envio' => [
                    'enviar_ahora' => $request->enviarInvitacionAhora == 'ahora' ? true : false,
                    'programar_envio' => $request->enviarInvitacionAhora == 'programar' ? true : false, 'fecha_envio_invitacion' => $request->enviarInvitacionAhora == 'programar' ? $request->fecha_envio_invitacion : Carbon::parse(Carbon::now())->format('Y-m-d\TH:i'),
                ],
            ]
        );
        $estatus = $request->tipo_guardado;
        if ($request->enviarInvitacionAhora == 'programar') {
            $estatus = 'Programado';
        }
        $duracion = Carbon::parse($request->fecha_curso)->diffInHours(Carbon::parse($request->fecha_fin));
        $recurso->update([
            'cursoscapacitaciones' => $request->cursoscapacitaciones,
            'tipo' => $request->tipo,
            'categoria_capacitacion_id' => $request->categoria_capacitacion_id,
            'fecha_curso' => $request->fecha_curso,
            'fecha_fin' => $request->fecha_fin,
            'duracion' => $duracion,
            'instructor' => $request->instructor,
            'descripcion' => $request->descripcion,
            'modalidad' => $request->modalidad,
            'ubicacion' => $request->ubicacion,
            'tipo_seleccion_participantes' => $request->tipo_seleccion_participantes,
            'configuracion_invitacion_envio' => $request->configuracion_invitacion_envio,
            'estatus' => $estatus,
        ]);
        if ($request->tipo_request == 'ajax') {
            return response()->json(['status' => 'success', 'message' => 'Recurso creado']);
        }

        return redirect()->route('admin.recursos.index')->with('success', 'Actualizado con éxito');
        // if ($recurso->cursoscapacitaciones != $request->cursoscapacitaciones) {
        //     if (Storage::exists('public/capacitaciones/certificados/' . $recurso->cursoscapacitaciones)) {
        //         Storage::move('public/capacitaciones/certificados/' . $recurso->cursoscapacitaciones, 'public/capacitaciones/certificados/' . $request->cursoscapacitaciones); //rename folder
        //     }
        // }
    }

    public function show(Recurso $recurso)
    {
        abort_if(Gate::denies('capacitaciones_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $recurso->load('participantes', 'empleados');

        return view('admin.recursos.show', compact('recurso'));
    }

    public function destroy(Recurso $recurso)
    {
        abort_if(Gate::denies('capacitaciones_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $deleted = $recurso->delete();
        if ($deleted) {
            return response()->json(['estatus' => 200, 'mensaje' => 'Registro eliminado con éxito']);
        } else {
            return response()->json(['estatus' => 500, 'mensaje' => 'No se pudo eliminar el registro']);
        }
    }

    public function massDestroy(MassDestroyRecursoRequest $request)
    {
        Recurso::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        //        abort_if(Gate::denies('recurso_create') && Gate::denies('recurso_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model = new Recurso();
        $model->id = $request->input('crud_id', 0);
        $model->exists = true;
        $media = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    public function guardarEvaluacionCapacitacion(Request $request)
    {
        $empleado = User::getCurrentUser()->empleado->id;
        $recurso = Recurso::find($request->recurso);
        $request->validate([
            'utilidadTemasVistos' => 'required',
            'calidadClaridadContenido' => 'required',
            'favorecioAprendizaje' => 'required',
            'materialesAudioVisualesCalidad' => 'required',
            'materialEntregadoCalidad' => 'required',
            'cumplioObjetivo' => 'required',
            'puntualidadInstructor' => 'required',
            'dominioTemasHerramientas' => 'required',
            'ritmoTonoVozUtilizado' => 'required',
            'estrategirasIncentivaronParticipacion' => 'required',
            'habilidadesPresentacion' => 'required',
            'comentariosAcercaInstructores' => 'nullable',
            'duracionCurso' => 'required',
            'horarioCurso' => 'required',
            'seguimientoEmpresa' => 'required',
            'recomendariaCurso' => 'required',
            'porqueSeRecomiendaElCurso' => 'nullable',
        ], [
            'utilidadTemasVistos.required' => 'El campo es requerido',
            'calidadClaridadContenido.required' => 'El campo es requerido',
            'favorecioAprendizaje.required' => 'El campo es requerido',
            'materialesAudioVisualesCalidad.required' => 'El campo es requerido',
            'materialEntregadoCalidad.required' => 'El campo es requerido',
            'cumplioObjetivo.required' => 'El campo es requerido',
            'puntualidadInstructor.required' => 'El campo es requerido',
            'dominioTemasHerramientas.required' => 'El campo es requerido',
            'ritmoTonoVozUtilizado.required' => 'El campo es requerido',
            'estrategirasIncentivaronParticipacion.required' => 'El campo es requerido',
            'habilidadesPresentacion.required' => 'El campo es requerido',
            'comentariosAcercaInstructores.required' => 'El campo es requerido',
            'duracionCurso.required' => 'El campo es requerido',
            'horarioCurso.required' => 'El campo es requerido',
            'seguimientoEmpresa.required' => 'El campo es requerido',
            'recomendariaCurso.required' => 'El campo es requerido',
            'porqueSeRecomiendaElCurso.required' => 'El campo es requerido',
        ]);
        $evaluacion = Arr::except($request->all(), 'recurso');

        if (Carbon::now()->isAfter(Carbon::parse($recurso->fecha_fin))) {
            $recurso->empleados()->syncWithoutDetaching([$empleado => ['evaluacion' => $evaluacion]]);

            return response()->json(['estatus' => 200, 'mensaje' => 'Evaluación almacenada']);
        } else {
            return response()->json(['estatus' => 500, 'mensaje' => 'Esta capacitación no acepta evaluaciones aún']);
        }
    }

    public function respuestaCapacitacion(Request $request)
    {
        $empleado = User::getCurrentUser()->empleado->id;
        $recurso = Recurso::find($request->recurso);

        if (Carbon::parse($recurso->fecha_limite)->isAfter(Carbon::now())) {
            $recurso->empleados()->syncWithoutDetaching([$empleado => ['es_aceptada' => $request->esAceptada]]);
            if ($request->esAceptada == 'true') {
                $mensaje = 'Capacitación Aceptada';
            } else {
                $mensaje = 'Capacitación Rechazada';
            }

            return response()->json(['estatus' => 200, 'mensaje' => $mensaje]);
        } else {
            return response()->json(['estatus' => 500, 'mensaje' => 'Esta capacitación no acepta más respuestas']);
        }
    }

    public function archivarCapacitacion(Request $request)
    {
        $empleado = User::getCurrentUser()->empleado->id;
        $recurso = Recurso::find($request->recurso);

        if (Carbon::parse($recurso->fecha_fin)->isBefore(Carbon::now()) || $request->aceptada == 'false') {
            $recurso->empleados()->syncWithoutDetaching([$empleado => ['archivado' => $request->archivado]]);
            if ($request->archivado == 'true') {
                $mensaje = 'Capacitación Archivada';
            } else {
                $mensaje = 'Capacitación Removida del Archivo';
            }

            return response()->json(['estatus' => 200, 'mensaje' => $mensaje]);
        } else {
            return response()->json(['estatus' => 500, 'mensaje' => 'Esta capacitación no se puede archivar, aún está en curso']);
        }
    }

    public function obtenerCapacitacionesPrincipales(Request $request)
    {
        $empleado = User::getCurrentUser()->empleado->id;
        //Capacitaciones Cards
        // $capacitacionesEnCurso = $this->obtenerCapacitacionesEnCursoDelParticipante($empleado);
        // $capacitacionesProximas = $this->obtenerCapacitacionesProximasDelParticipante($empleado);
        // $capacitacionesTerminadas = $this->obtenerCapacitacionesTerminadasDelParticipante($empleado);
        // $capacitacionesCard = collect([
        //     'curso' => $capacitacionesEnCurso,
        //     'proximas' => $capacitacionesProximas,
        //     'terminadas' => $capacitacionesTerminadas
        // ]);
        $capacitacionesCard = $this->obtenerCapacitacionesMezcladas($empleado, $request->filtro);

        return response()->json(['capacitaciones' => $capacitacionesCard]);
    }

    public function obtenerCapacitacionesArchivadas()
    {
        $empleado = User::getCurrentUser()->empleado->id;
        $capacitacionesCard = $this->obtenerCapacitacionesMezcladas($empleado, 'todo', true);

        return response()->json(['capacitaciones' => $capacitacionesCard]);
    }

    public function obtenerCapacitacionesEnCursoDelParticipante($empleado, $archivado = false)
    {
        return Recurso::capacitacionesEnCurso()->with(['archivos', 'categoria_capacitacion', 'empleados' => function ($q) use ($empleado) {
            $q->select('empleados.id', 'empleados.name')->where('empleado_id', $empleado);
        }])->whereHas('empleados', function ($query) use ($empleado, $archivado) {
            $query->where('empleado_id', $empleado)->where('archivado', $archivado);
        })->get();
    }

    public function obtenerCapacitacionesProximasDelParticipante($empleado, $archivado = false)
    {
        return Recurso::capacitacionesProximas()->with(['archivos', 'categoria_capacitacion', 'empleados' => function ($q) use ($empleado) {
            $q->select('empleados.id', 'empleados.name')->where('empleado_id', $empleado);
        }])->whereHas('empleados', function ($query) use ($empleado, $archivado) {
            $query->where('empleado_id', $empleado)->where('archivado', $archivado);
        })->get();
    }

    public function obtenerCapacitacionesTerminadasDelParticipante($empleado, $archivado = false)
    {
        return Recurso::capacitacionesTerminadas()->with(['archivos', 'categoria_capacitacion', 'empleados' => function ($q) use ($empleado) {
            $q->select('empleados.id', 'empleados.name')->where('empleado_id', $empleado);
        }])->whereHas('empleados', function ($query) use ($empleado, $archivado) {
            $query->where('empleado_id', $empleado)->where('archivado', $archivado);
        })->get();
    }

    private function obtenerCapacitacionesMezcladas($empleado, $filtro = 'todo', $archivado = false)
    {
        return Recurso::with(['archivos', 'categoria_capacitacion', 'empleados' => function ($q) use ($empleado) {
            $q->select('empleados.id', 'empleados.name')->where('empleado_id', $empleado);
        }])->whereHas('empleados', function ($query) use ($empleado, $archivado, $filtro) {
            if ($filtro == 'todo') {
                return $query->where('empleado_id', $empleado)->where('archivado', $archivado);
            } elseif ($filtro == 'aceptadas') {
                return $query->where('empleado_id', $empleado)->where('archivado', $archivado)->where('es_aceptada', true);
            } elseif ($filtro == 'rechazadas') {
                return $query->where('empleado_id', $empleado)->where('archivado', $archivado)->where('es_aceptada', false);
            } elseif ($filtro == 'sin_respuesta') {
                return $query->where('empleado_id', $empleado)->where('archivado', $archivado)->where('es_aceptada', null);
            }
        })->where('estatus', 'Enviado')->get();
    }

    public function suscribir(Request $request)
    {
        if ($request->id_recurso != null && $request->id_empleado != null) {
            $recurso = Recurso::find(intval($request->id_recurso));
            // dd($recurso->empleados);
            $exists = $recurso->empleados()->where('empleado_id', intval($request->id_empleado))->exists();
            if (! $exists) {
                $recurso->empleados()->attach($request->id_empleado);

                return response()->json(['success' => true]);
            } else {
                return response()->json(['exists' => true]);
            }
        } else {
            return response()->json(['error' => true]);
        }
    }

    public function participantes($recurso)
    {
        $empleados = Recurso::find($recurso)->empleados;

        return datatables()->of($empleados)->toJson();
    }

    public function getParticipantes($recurso)
    {
        $int_recurso = intval($recurso);
        $recurso_data = Recurso::with('categoria_capacitacion')->find($int_recurso);
        $recurso_info = ['recurso' => $recurso_data, 'empleados' => $recurso_data->empleados];

        return $recurso_info;
    }

    public function calificarParticipante(Request $request)
    {
        $request->validate([
            'calificacion' => 'nullable|numeric|min:0|max:100',
            'recurso' => 'required|exists:recursos,id',
            'certificado' => 'nullable|mimes:jpeg,bmp,png,gif,svg,pdf|max:50000',
        ]);
        $empleado = json_decode($request->empleado);
        $recurso = Recurso::find($request->recurso);
        if (! Storage::disk('capacitaciones')->exists('certificados')) {
            Storage::disk('capacitaciones')->makeDirectory('certificados');
        }
        $certificadoImg = $empleado->pivot->certificado;
        if ($request->file('certificado')) {
            $carpetaCapacitacion = "{$recurso->id}_capacitacion";
            if (! Storage::disk('capacitaciones')->exists("certificados/{$carpetaCapacitacion}/{$empleado->n_empleado}")) {
                Storage::disk('capacitaciones')->makeDirectory("certificados/{$carpetaCapacitacion}/{$empleado->n_empleado}");
            }

            $isExists = Storage::disk('capacitaciones')->exists("/certificados/{$carpetaCapacitacion}/{$empleado->n_empleado}/{$certificadoImg}");
            if ($isExists) {
                if ($certificadoImg != null) {
                    unlink(storage_path("/app/public/capacitaciones/certificados/{$carpetaCapacitacion}/{$empleado->n_empleado}/{$certificadoImg}"));
                }
            }
            $extension = pathinfo($request->file('certificado')->getClientOriginalName(), PATHINFO_EXTENSION);
            $certificadoImg = "CERTIFICADO_{$empleado->n_empleado}.{$extension}";
            $route = "public/capacitaciones/certificados/{$carpetaCapacitacion}/{$empleado->n_empleado}";
            $request->file('certificado')->storeAs($route, $certificadoImg);
        }

        $recurso->empleados()->syncWithoutDetaching([$empleado->id => ['calificacion' => $request->calificacion, 'certificado' => $certificadoImg]]);

        return response()->json(['estatus' => 200, 'mensaje' => 'Información Actualizada']);
    }

    public function reprogramarCapacitacion(Request $request, Recurso $recurso)
    {
        $request->validate([
            'fecha_curso' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_curso',
            'fecha_limite' => 'required|date|before:fecha_curso',
        ]);

        if (Carbon::now()->isBefore(Carbon::parse($recurso->fecha_inicio)) || $recurso->estatus == 'Cancelado') {
            if ($recurso->configuracion_invitacion_envio->programar_envio) {
                $new_fecha_limite = Carbon::parse($request->fecha_limite)->subDays(3);
                $new_fecha_limite->toDateString();
                $request->validate([
                    'fecha_envio_invitacion' => 'required|date|before:'.$new_fecha_limite,
                ]);
            }

            $recurso->update([
                'fecha_curso' => $request->fecha_curso,
                'fecha_fin' => $request->fecha_fin,
                'fecha_limite' => $request->fecha_limite,
            ]);
            //Enviar correo avisando reprogramacion
            foreach ($recurso->empleados as $empleado) {
                Mail::to(removeUnicodeCharacters($empleado->email))->queue(new CapacitacionReprogramadaMail($recurso, $empleado));
            }

            return response()->json(['estatus' => 200, 'mensaje' => 'Capacitación Reprogramada']);
        } else {
            return response()->json(['estatus' => 500, 'mensaje' => 'Esta capacitación no se ha podido reprogramar ya que está en curso, puedes cancelar la capacitación y reprogramarla']);
        }
    }

    public function cancelarCapacitacion(Recurso $recurso)
    {
        if (Carbon::now()->lessThanOrEqualTo(Carbon::parse($recurso->fecha_fin))) {
            $recurso->update([
                'estatus' => 'Cancelado',
            ]);
            //Enviar correo avisando reprogramacion
            foreach ($recurso->empleados as $empleado) {
                Mail::to(removeUnicodeCharacters($empleado->email))->queue(new CapacitacionCanceladaMail($recurso, $empleado));
            }

            // $extension = pathinfo($request->file('certificado')->getClientOriginalName(), PATHINFO_EXTENSION);
            // $certificadoImg = "CERTIFICADO_{$empleado->n_empleado}.{$extension}";
            // $route = "public/capacitaciones/certificados/{$carpetaCapacitacion}/{$empleado->n_empleado}";
            // $request->file('certificado')->storeAs($route, $certificadoImg);
            return response()->json(['estatus' => 200, 'mensaje' => 'Capacitación Cancelada']);
        } else {
            return response()->json(['estatus' => 500, 'mensaje' => 'No se ha podido cancelar la capacitación, la capacitación ha finalizado el día'.$recurso->fecha_fin_name]);
        }
    }

    public function enviarInvitacionPorCorreoAhora(Recurso $recurso)
    {
        if (Carbon::now()->isBefore(Carbon::parse($recurso->fecha_limite))) {
            foreach ($recurso->empleados as $empleado) {
                Mail::to(removeUnicodeCharacters($empleado->email))->queue(new InvitacionCapacitaciones($empleado, $recurso));
            }

            return response()->json(['estatus' => 200, 'mensaje' => 'Invitaciones enviadas']);
        } else {
            return response()->json(['estatus' => 500, 'mensaje' => 'No se han podido enviar las invitaciones ya que la fecha límite de confirmación para la capacitación fue:'.$recurso->fecha_limite_name]);
        }
    }

    public function guardarAsistenciaCapacitacion(Request $request, Recurso $recurso)
    {
        $empleado = $request->empleado;
        $asistio = $request->asistio == 'true' ? true : false;

        $recurso->empleados()->syncWithoutDetaching([$empleado => ['asistio' => $asistio]]);
        if ($asistio) {
            return response()->json(['estatus' => 200, 'mensaje' => 'Asistencia Almacenada']);
        } else {
            return response()->json(['estatus' => 201, 'mensaje' => 'Asistencia Removida']);
        }
    }
    // public function eliminarParticipante(Request $request)
    // {
    //     $int_recurso = intval($request->id_recurso);
    //     $int_empleado = intval($request->id_empleado);
    //     $recurso = Recurso::find($int_recurso);
    //     $recurso->empleados()->detach($int_empleado);
    //     if ($recurso) {
    //         return response()->json(['success' => true]);
    //     } else {
    //         return response()->json(['error' => true]);
    //     }
    // }
}
