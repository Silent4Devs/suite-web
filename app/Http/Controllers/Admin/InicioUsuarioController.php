<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\User;
use App\Models\PlanBaseActividade;
use App\Models\AuditoriaAnual;
use App\Models\Recurso;

use App\Models\IncidentesSeguridad;
use App\Models\RiesgoIdentificado;
use App\Models\Quejas;
use App\Models\Denuncias;
use App\Models\Mejoras;
use App\Models\Sugerencias;

use App\Models\Activo;
use App\Models\Documento;
use App\Models\PlanImplementacion;
use App\Models\RevisionDocumento;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;


class inicioUsuarioController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('mi_perfil_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $usuario = auth()->user();
        $empleado_id = $usuario->empleado ? $usuario->empleado->id : 0;
        //$gantt_path = 'storage/gantt/gantt_inicial.json';
        $actividades = [];
        // if (file_exists($gantt_path)) {
        //     $file_gantt = json_decode(file_get_contents($gantt_path), true);
        //     $actividades = array_filter($file_gantt['tasks'], function ($tarea) use ($empleado_id) {
        //         $assigs = $tarea['assigs'];
        //         foreach ($assigs as $assig) {
        //             if ($assig['resourceId'] == $empleado_id) {
        //                 return $tarea;
        //             }
        //         }
        //     });
        // }
        $implementacion = PlanImplementacion::first();
        $tasks = $implementacion->tasks;
        foreach ($tasks as $task) {
            $task->end = intval($task->end);
            $task->start = intval($task->start);
            $task->canAdd = $task->canAdd == 'true' ? true : false;
            $task->canWrite = $task->canWrite == 'true' ? true : false;
            $task->duration = intval($task->duration);
            $task->progress = intval($task->progress);
            $task->canDelete = $task->canDelete == 'true' ? true : false;
            isset($task->level) ? $task->level = intval($task->level) : $task->level = 0;
            isset($task->collapsed) ? $task->collapsed = $task->collapsed == 'true' ? true : false : $task->collapsed = false;
            $task->canAddIssue = $task->canAddIssue == 'true' ? true : false;
            $task->endIsMilestone = $task->endIsMilestone == 'true' ? true : false;
            $task->startIsMilestone = $task->startIsMilestone == 'true' ? true : false;
            $task->progressByWorklog = $task->progressByWorklog == 'true' ? true : false;
        }
        $implementacion->tasks = $tasks;
        // if (!isset($implementacion->assigs)) {
        //     $implementacion = (object)array_merge((array)$implementacion, array('assigs' => []));
        // }
        $actividades = collect($implementacion->tasks)->filter(function ($task) use ($empleado_id, $implementacion) {
            if ($task->level > 1) {
                if (isset($task->assigs)) {
                    $assigs = $task->assigs;
                    $task->parent = $implementacion->parent;
                    $task->slug = $implementacion->slug;
                    foreach ($assigs as $assig) {
                        if ($assig->resourceId == $empleado_id) {
                            return $task;
                        }
                    }
                }
            }
        });
        $auditorias_anual = AuditoriaAnual::get();
        $recursos = Recurso::whereHas('empleados', function ($query) use ($usuario) {
            $query->where('empleados.id', $usuario->id);
        })->get();

        $documentos_publicados = Documento::where('estatus', Documento::PUBLICADO)->latest('updated_at')->get()->take(5);
        $revisiones = [];
        $mis_documentos = [];
        if ($usuario->empleado) {
            $revisiones = RevisionDocumento::with('documento')->where('empleado_id', $usuario->empleado->id)->where('archivado', RevisionDocumento::NO_ARCHIVADO)->get();
            $mis_documentos = Documento::where('elaboro_id', $usuario->empleado->id)->get();
        }


        return view('admin.inicioUsuario.index', compact('usuario', 'recursos', 'actividades', 'documentos_publicados', 'auditorias_anual', 'revisiones', 'mis_documentos'));
    }

    public function optenerTareas($tarea)
    {
        $assigs = $tarea['assigs'];
        foreach ($assigs as $assig) {
            if ($assig == auth()->user()) {
                return $tarea;
            }
        }
    }

    public function quejas()
    {
        abort_if(Gate::denies('quejas_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.inicioUsuario.formularios.quejas');
    }
    public function storeQuejas(Request $request)
    {
        Quejas::create([
            'anonimo' => $request->anonimo,
            'empleado_quejo_id' => auth()->user()->empleado->id,
            'descripcion' => $request->descripcion,
            'evidencia' => $request->evidencia,
            'quejado' => $request->quejado,
        ]);

        return redirect()->route('admin.inicio-Usuario.index');
    }

    public function denuncias()
    {
        abort_if(Gate::denies('denuncias_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.inicioUsuario.formularios.denuncias');
    }
    public function storeDenuncias(Request $request)
    {
        Denuncias::create([
            'anonimo' => $request->anonimo,
            'empleado_denuncio_id' => auth()->user()->empleado->id,
            'descripcion' => $request->descripcion,
            'evidencia' => $request->evidencia,
            'denunciado' => $request->denunciado,
            'area_denunciado' => $request->area_denunciado,
            'tipo' => $request->tipo,
        ]);

        return redirect()->route('admin.inicio-Usuario.index');
    }

    public function mejoras()
    {
        abort_if(Gate::denies('mejoras_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.inicioUsuario.formularios.mejoras');
    }
    public function storeMejoras(Request $request)
    {
        Mejoras::create([
            'empleado_mejoro_id' => auth()->user()->empleado->id,
            'descripcion' => $request->descripcion,
            'mejora' => $request->mejora,
        ]);

        return redirect()->route('admin.inicio-Usuario.index');
    }

    public function sugerencias()
    {
        abort_if(Gate::denies('sugerencias_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.inicioUsuario.formularios.sugerencias');
    }
    public function storeSugerencias(Request $request)
    {
        Sugerencias::create([
            'empleado_sugerir_id' => auth()->user()->empleado->id,
            'descripcion' => $request->descripcion,
            'sugerencia_dirigida' => $request->sugerencia_dirigida,
        ]);

        return redirect()->route('admin.inicio-Usuario.index');
    }

    public function seguridad()
    {
        abort_if(Gate::denies('incidentes_seguridad_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $activos = Activo::get();
        return view('admin.inicioUsuario.formularios.seguridad', compact('activos'));
    }
    public function storeSeguridad(Request $request)
    {


        // $request->validate([
        //     'fecha'=>'required|date',
        //     'titulo'=>'required|string',
        //     'descripcion'=>'required|string',
        //     'activos_afectados'=>'required|string',
        // ]);

        $incidentes_seguridad = IncidentesSeguridad::create([
            'fecha' => $request->fecha,
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'activos_afectados' => $request->activos_afectados,
            'empleado_reporto_id' => auth()->user()->empleado->id,
        ]);

        $archivos = explode(',', $request->input('archivo'));

        foreach ($archivos as $archivo) {
            if ($request->input('archivo', false)) {
                $incidentes_seguridad->addMedia(storage_path('tmp/uploads/' . $archivo))->toMediaCollection('archivo');
            }

            if ($media = $request->input('ck-media', false)) {
                Media::whereIn('id', $media)->update(['model_id' => $incidentes_seguridad->id]);
            }
        }

        return redirect()->route('admin.inicio-Usuario.index');
    }

    public function evidenciaSeguridad()
    {
    }



    public function riesgos()
    {
        abort_if(Gate::denies('riesgos_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.inicioUsuario.formularios.riesgos');
    }
    public function storeRiesgos(Request $request)
    {

        RiesgoIdentificado::create([
            'fecha' => $request->fecha,
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'activos_afectados' => $request->activos_afectados,
            'proceso' => $request->proceso,
            'empleado_reporto_id' => auth()->user()->empleado->id,
        ]);

        return redirect()->route('admin.inicio-Usuario.index');
    }
}
