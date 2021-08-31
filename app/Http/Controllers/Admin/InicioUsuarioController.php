<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use App\Models\User;
use App\Models\PlanBaseActividade;
use App\Models\AuditoriaAnual;
use App\Models\Recurso;
use App\Models\Proceso;
use App\Models\Area;
use App\Models\Empleado;
use App\Models\Sede;
use App\Models\SubcategoriaIncidente;

use App\Models\IncidentesSeguridad;
use App\Models\RiesgoIdentificado;
use App\Models\Quejas;
use App\Models\Denuncias;
use App\Models\Mejoras;
use App\Models\Sugerencias;
use App\Models\AnalisisSeguridad;

use Intervention\Image\Facades\Image;
use App\Models\EvidenciasQueja;
use App\Models\EvidenciasSeguridad;
use App\Models\EvidenciasRiesgo;

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
        $implementaciones = PlanImplementacion::get();
        $actividades = collect();
        if ($implementaciones) {
            foreach($implementaciones as $implementacion){

            
                $tasks = $implementacion->tasks;
                foreach ($tasks as $task) {
                    $task->parent_id = $implementacion->id;
                    $task->status = isset($task->status) ? $task->status : 'STATUS_UNDEFINED';
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
                $actividades_collet = collect($implementacion->tasks)->filter(function ($task) use ($empleado_id, $implementacion) {
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

                $actividades->push($actividades_collet);
            }
        }
        $actividades = $actividades->flatten(1);

        $contador_actividades = 0; 

        foreach($actividades as $actividad){
            $progreso = $actividad->progress;

            if (intval($progreso) < 100) {
                $contador_actividades++;
            }
        }

        $auditorias_anual = AuditoriaAnual::get();
        $recursos = Recurso::whereHas('empleados', function ($query) use ($usuario) {
            $query->where('empleados.id', $usuario->id);
        })->get();

        $contador_recursos = Recurso::whereHas('empleados', function ($query) use ($usuario) {
            $query->where('empleados.id', $usuario->id);
        })->where('fecha_fin', '>=', Carbon::now()->toDateString())->count(); 

        $documentos_publicados = Documento::with('macroproceso')->where('estatus', Documento::PUBLICADO)->latest('updated_at')->get()->take(5);
        $revisiones = [];
        $mis_documentos = [];
        $contador_revisiones = 0;
        if ($usuario->empleado) {
            $revisiones = RevisionDocumento::with('documento')->where('empleado_id', $usuario->empleado->id)->where('archivado', RevisionDocumento::NO_ARCHIVADO)->get();

            $contador_revisiones = RevisionDocumento::with('documento')->where('empleado_id', $usuario->empleado->id)->where('archivado', RevisionDocumento::NO_ARCHIVADO)->where('estatus', Documento::SOLICITUD_REVISION)->count();
            $mis_documentos = Documento::with('macroproceso')->where('elaboro_id', $usuario->empleado->id)->get();
        }


        return view('admin.inicioUsuario.index', compact('usuario', 'recursos', 'actividades', 'documentos_publicados', 'auditorias_anual', 'revisiones', 'mis_documentos', 'contador_actividades', 'contador_revisiones', 'contador_recursos'));
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
        $areas = Area::get();

        $procesos = Proceso::get();

        $activos = Activo::get();

        $empleados = Empleado::get();

        $sedes = Sede::get();

        abort_if(Gate::denies('quejas_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.inicioUsuario.formularios.quejas', compact('areas', 'procesos' ,'empleados', 'activos', 'sedes'));
    }
    public function storeQuejas(Request $request)
    {

        $quejas = Quejas::create([
            'anonimo' => $request->anonimo,
            'empleado_quejo_id' => auth()->user()->empleado->id,

            'area_quejado' => $request->area_quejado,
            'colaborador_quejado' => $request->colaborador_quejado,
            'proceso_quejado' => $request->proceso_quejado,
            'externo_quejado' => $request->externo_quejado,

            'titulo' => $request->descripcion,
            'fecha' => $request->fecha,
            'sede' => $request->sede,
            'ubicacion' => $request->ubicacion,
            'descripcion' => $request->descripcion,
        ]);

        AnalisisSeguridad::create([
            'quejas_id' => $quejas->id,
            'formulario' => 'queja',
        ]);



        $image = null;

        if($request->file('evidencia') != null or !empty($request->file('evidencia'))){

            foreach($request->file('evidencia') as $file){
                $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);

                $name_image = basename(pathinfo($file->getClientOriginalName(), PATHINFO_BASENAME), "." . $extension);

                $new_name_image = 'Queja_file_' . $quejas->id . '_' . $name_image . '.' . $extension;

                $route = 'public/evidencias_quejas';

                $image = $new_name_image;

                $file->storeAs($route, $image);

                EvidenciasQueja::create([
                    'evidencia' => $image,
                    'id_quejas' => $quejas->id,
                ]);

            }
        }


        
        return redirect()->route('admin.inicio-Usuario.index');
    }

    public function denuncias()
    {
        $empleados = Empleado::get();

        $sedes = Sede::get();

        abort_if(Gate::denies('denuncias_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.inicioUsuario.formularios.denuncias', compact('empleados' , 'sedes'));
    }
    public function storeDenuncias(Request $request)
    {
        $denuncias = Denuncias::create([
            'anonimo' => $request->anonimo,
            'empleado_denuncio_id' => auth()->user()->empleado->id,
            'descripcion' => $request->descripcion,
            'empleado_denunciado_id' => $request->empleado_denunciado_id,
            'tipo' => $request->tipo,
            'sede' => $request->sede,
            'ubicacion' => $request->ubicacion,
            'fecha' => $request->fecha,
        ]);

        AnalisisSeguridad::create([
            'denuncias_id' => $denuncias->id,
            'formulario' => 'denuncia',
        ]);

        return redirect()->route('admin.inicio-Usuario.index');
    }

    public function mejoras()
    {

        $areas = Area::get();

        $procesos = Proceso::get();

        abort_if(Gate::denies('mejoras_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.inicioUsuario.formularios.mejoras', compact('areas', 'procesos'));
    }
    public function storeMejoras(Request $request)
    {
        $mejoras = Mejoras::create([
            'empleado_mejoro_id' => auth()->user()->empleado->id,
            'descripcion' => $request->descripcion,
            'beneficios' => $request->beneficios,
            'titulo' => $request->titulo,
            'area_mejora' => $request->area_mejora,
            'proceso_mejora' => $request->proceso_mejora,
            'tipo' => $request->tipo,
            'otro' => $request->otro,
        ]);

        AnalisisSeguridad::create([
            'mejoras_id' => $mejoras->id,
            'formulario' => 'mejora',
        ]);

        return redirect()->route('admin.inicio-Usuario.index');
    }

    public function sugerencias()
    {
        $areas = Area::get();

        $empleados = Empleado::get();

        $procesos = Proceso::get();

        abort_if(Gate::denies('sugerencias_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.inicioUsuario.formularios.sugerencias', compact('areas', 'empleados', 'procesos'));
    }
    public function storeSugerencias(Request $request)
    {
        $sugerencias = Sugerencias::create([
            'empleado_sugirio_id' => auth()->user()->empleado->id,

            'area_sugerencias' => $request->area_sugerencias,
            'proceso_sugerencias' => $request->proceso_sugerencias,

            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
        ]);

        AnalisisSeguridad::create([
            'sugerencias_id' => $sugerencias->id,
            'formulario' => 'sugerencia',
        ]);

        return redirect()->route('admin.inicio-Usuario.index');
    }

    public function seguridad()
    {

        $areas = Area::get();

        $procesos = Proceso::get();

        $activos = Activo::get();

        $empleados = Empleado::get();

        $sedes = Sede::get();

        $subcategorias = SubcategoriaIncidente::get();


        abort_if(Gate::denies('incidentes_seguridad_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $activos = Activo::get();
        return view('admin.inicioUsuario.formularios.seguridad', compact('activos', 'areas', 'procesos', 'sedes', 'subcategorias'));
    }
    public function storeSeguridad(Request $request)
    {

        $incidentes_seguridad = IncidentesSeguridad::create([
            'titulo' => $request->titulo,
            'fecha' => $request->fecha,
            'sede' => $request->sede,
            'ubicacion' => $request->ubicacion,
            'descripcion' => $request->descripcion,
            'areas_afectados' => $request->areas_afectados,
            'procesos_afectados' => $request->procesos_afectados,
            'activos_afectados' => $request->activos_afectados,
            'empleado_reporto_id' => auth()->user()->empleado->id,
        ]);


        AnalisisSeguridad::create([
            'seguridad_id' => $incidentes_seguridad->id,
            'formulario' => 'seguridad',
        ]);



        $image = null;

        if($request->file('evidencia') != null or !empty($request->file('evidencia'))){

            foreach($request->file('evidencia') as $file){
                $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);

                $name_image = basename(pathinfo($file->getClientOriginalName(), PATHINFO_BASENAME), "." . $extension);

                $new_name_image = 'Seguridad_file_' . $incidentes_seguridad->id . '_' . $name_image . '.' . $extension;

                $route = 'public/evidencias_seguridad';

                $image = $new_name_image;

                $file->storeAs($route, $image);

                EvidenciasSeguridad::create([
                    'evidencia' => $image,
                    'id_seguridad' => $incidentes_seguridad->id,
                ]);

            }
        }

        return redirect()->route('admin.inicio-Usuario.index');
    }

    public function evidenciaSeguridad()
    {
    }



    public function riesgos()
    {
        $areas = Area::get();

        $procesos = Proceso::get();

        $activos = Activo::get();

        $empleados = Empleado::get();

        $sedes = Sede::get();

        abort_if(Gate::denies('riesgos_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.inicioUsuario.formularios.riesgos', compact('activos', 'areas', 'procesos', 'sedes'));
    }
    public function storeRiesgos(Request $request)
    {

        $riesgos = RiesgoIdentificado::create([
            'titulo' => $request->titulo,
            'fecha' => $request->fecha,
            'sede' => $request->sede,
            'ubicacion' => $request->ubicacion,
            'descripcion' => $request->descripcion,
            'comentarios' => $request->comentarios,
            'areas_afectados' => $request->areas_afectados,
            'procesos_afectados' => $request->procesos_afectados,
            'activos_afectados' => $request->activos_afectados,
            'empleado_reporto_id' => auth()->user()->empleado->id,
        ]);

        
        AnalisisSeguridad::create([
            'riesgos_id' => $riesgos->id,
            'formulario' => 'riesgo',
        ]);


        $image = null;

        if($request->file('evidencia') != null or !empty($request->file('evidencia'))){

            foreach($request->file('evidencia') as $file){
                $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);

                $name_image = basename(pathinfo($file->getClientOriginalName(), PATHINFO_BASENAME), "." . $extension);

                $new_name_image = 'Riesgo_file_' . $riesgos->id . '_' . $name_image . '.' . $extension;

                $route = 'public/evidencias_riesgos';

                $image = $new_name_image;

                $file->storeAs($route, $image);

                EvidenciasRiesgo::create([
                    'evidencia' => $image,
                    'id_riesgos' => $riesgos->id,
                ]);

            }
        }

        return redirect()->route('admin.inicio-Usuario.index');
    }
}
