<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Mail\AceptacionAccionCorrectivaEmail;
use App\Mail\AtencionQuejaAtendidaEmail;
use App\Mail\CierreQuejaAceptadaEmail;
use App\Mail\NotificacionResponsableQuejaEmail;
use App\Mail\ResolucionQuejaRechazadaEmail;
use App\Mail\SeguimientoQuejaClienteEmail;
use App\Mail\SolicitarCierreQuejaEmail;
use App\Mail\SolicitudAprobacion;
use App\Models\AccionCorrectiva;
use App\Models\Activo;
use App\Models\AnalisisQuejasClientes;
use App\Models\AnalisisSeguridad;
use App\Models\AprobadorSeleccionado;
use App\Models\Area;
use App\Models\CategoriaIncidente;
use App\Models\Denuncias;
use App\Models\Empleado;
use App\Models\EvidenciaQuejasClientes;
use App\Models\EvidenciasQuejasClientesCerrado;
use App\Models\EvidenciasSeguridad;
use App\Models\FirmaCentroAtencion;
use App\Models\FirmaModule;
use App\Models\IncidentesSeguridad;
use App\Models\Mejoras;
use App\Models\Organizacion;
use App\Models\Proceso;
use App\Models\Quejas;
use App\Models\QuejasCliente;
use App\Models\RiesgoIdentificado;
use App\Models\Sede;
use App\Models\SubcategoriaIncidente;
use App\Models\Sugerencias;
use App\Models\TimesheetCliente;
use App\Models\TimesheetProyecto;
use App\Models\User;
use App\Traits\ObtenerOrganizacion;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail; //mejora apunta a este modelo

class DeskController extends Controller
{
    use ObtenerOrganizacion;

    public function index()
    {
        abort_if(Gate::denies('centro_de_atencion_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $incidentesSeguridad = IncidentesSeguridad::getAll();
        $incidentes_seguridad = $incidentesSeguridad->where('archivado', IncidentesSeguridad::NO_ARCHIVADO);
        $riesgos_identificados = RiesgoIdentificado::getAll();
        $quejas = Quejas::getAll();
        $denuncias = Denuncias::getAll();
        $mejoras = Mejoras::getAll();
        $sugerencias = Sugerencias::getAll();
        $quejasClientes = QuejasCliente::getAll();

        $total_seguridad = $incidentesSeguridad->count();
        $nuevos_seguridad = $incidentesSeguridad->where('estatus', 'Sin atender')->count();
        $en_curso_seguridad = $incidentesSeguridad->where('estatus', 'En curso')->count();
        $en_espera_seguridad = $incidentesSeguridad->where('estatus', 'En espera')->count();
        $cerrados_seguridad = $incidentesSeguridad->where('estatus', 'Cerrado')->count();
        $cancelados_seguridad = $incidentesSeguridad->where('estatus', 'No procedente')->count();

        $total_riesgos = $riesgos_identificados->count();
        $nuevos_riesgos = $riesgos_identificados->where('estatus', 'nuevo')->count();
        $en_curso_riesgos = $riesgos_identificados->where('estatus', 'en curso')->count();
        $en_espera_riesgos = $riesgos_identificados->where('estatus', 'en espera')->count();
        $cerrados_riesgos = $riesgos_identificados->where('estatus', 'cerrado')->count();
        $cancelados_riesgos = $riesgos_identificados->where('estatus', 'cancelado')->count();

        $total_quejas = $quejas->count();
        $nuevos_quejas = $quejas->where('estatus', 'nuevo')->count();
        $en_curso_quejas = $quejas->where('estatus', 'en curso')->count();
        $en_espera_quejas = $quejas->where('estatus', 'en espera')->count();
        $cerrados_quejas = $quejas->where('estatus', 'cerrado')->count();
        $cancelados_quejas = $quejas->where('estatus', 'cancelado')->count();

        $total_quejasClientes = $quejasClientes->count();
        $nuevos_quejasClientes = $quejasClientes->where('estatus', 'Sin atender')->count();
        $en_curso_quejasClientes = $quejasClientes->where('estatus', 'En curso')->count();
        $en_espera_quejasClientes = $quejasClientes->where('estatus', 'En espera')->count();
        $cerrados_quejasClientes = $quejasClientes->where('estatus', 'Cerrado')->count();
        $cancelados_quejasClientes = $quejasClientes->where('estatus', 'No procedente')->count();

        $total_denuncias = $denuncias->count();
        $nuevos_denuncias = $denuncias->where('estatus', 'nuevo')->count();
        $en_curso_denuncias = $denuncias->where('estatus', 'en curso')->count();
        $en_espera_denuncias = $denuncias->where('estatus', 'en espera')->count();
        $cerrados_denuncias = $denuncias->where('estatus', 'cerrado')->count();
        $cancelados_denuncias = $denuncias->where('estatus', 'cancelado')->count();

        $total_mejoras = $mejoras->count();
        $nuevos_mejoras = $mejoras->where('estatus', 'nuevo')->count();
        $en_curso_mejoras = $mejoras->where('estatus', 'en curso')->count();
        $en_espera_mejoras = $mejoras->where('estatus', 'en espera')->count();
        $cerrados_mejoras = $mejoras->where('estatus', 'cerrado')->count();
        $cancelados_mejoras = $mejoras->where('estatus', 'cancelado')->count();

        $total_sugerencias = $sugerencias->count();
        $nuevos_sugerencias = $sugerencias->where('estatus', 'nuevo')->count();
        $en_curso_sugerencias = $sugerencias->where('estatus', 'en curso')->count();
        $en_espera_sugerencias = $sugerencias->where('estatus', 'en espera')->count();
        $cerrados_sugerencias = $sugerencias->where('estatus', 'cerrado')->count();
        $cancelados_sugerencias = $sugerencias->where('estatus', 'cancelado')->count();

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.desk.index', compact(
            'logo_actual',
            'empresa_actual',
            'incidentes_seguridad',
            'riesgos_identificados',
            'quejas',
            'denuncias',
            'mejoras',
            'sugerencias',
            'total_seguridad',
            'nuevos_seguridad',
            'en_curso_seguridad',
            'en_espera_seguridad',
            'cerrados_seguridad',
            'cancelados_seguridad',
            'total_riesgos',
            'nuevos_riesgos',
            'en_curso_riesgos',
            'en_espera_riesgos',
            'cerrados_riesgos',
            'cancelados_riesgos',
            'total_quejas',
            'nuevos_quejas',
            'en_curso_quejas',
            'en_espera_quejas',
            'cerrados_quejas',
            'cancelados_quejas',
            'total_quejasClientes',
            'nuevos_quejasClientes',
            'en_curso_quejasClientes',
            'en_espera_quejasClientes',
            'cerrados_quejasClientes',
            'cancelados_quejasClientes',
            'total_denuncias',
            'nuevos_denuncias',
            'en_curso_denuncias',
            'en_espera_denuncias',
            'cerrados_denuncias',
            'cancelados_denuncias',
            'total_mejoras',
            'nuevos_mejoras',
            'en_curso_mejoras',
            'en_espera_mejoras',
            'cerrados_mejoras',
            'cancelados_mejoras',
            'total_sugerencias',
            'nuevos_sugerencias',
            'en_curso_sugerencias',
            'en_espera_sugerencias',
            'cerrados_sugerencias',
            'cancelados_sugerencias',
        ));
    }

    public function indexSeguridad()
    {
        abort_if(Gate::denies('centro_atencion_incidentes_de_seguridad_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $incidentes_seguridad = IncidentesSeguridad::where('archivado', false)->get();

        return datatables()->of($incidentes_seguridad)->toJson();
    }

    public function editSeguridad(Request $request, $id_incidente)
    {
        abort_if(Gate::denies('centro_atencion_incidentes_de_seguridad_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $modulo = 1;

        $submodulo = 1;

        $incidentesSeguridad = IncidentesSeguridad::findOrfail(intval($id_incidente))->load('evidencias_seguridad');

        $aprobadores = AprobadorSeleccionado::where('seguridad_id', $incidentesSeguridad->id)->first();

        $aprobadoresArray = [];

        if ($aprobadores) {
            // Convierte el campo aprobadores de JSON a array
            $aprobadoresArray = json_decode($aprobadores->aprobadores, true);
        }

        $incidentesSeguridad->descripcion = strip_tags($incidentesSeguridad->descripcion);

        $incidentesSeguridad->justificacion = strip_tags($incidentesSeguridad->justificacion);

        $analisis = AnalisisSeguridad::where('formulario', '=', 'seguridad')->where('seguridad_id', intval($id_incidente))->first();

        $activos = Activo::getAll();

        $empleados = Empleado::getaltaAll();

        $firmaModules = FirmaModule::where('modulo_id', $modulo)->where('submodulo_id', $submodulo)->first();

        if ($firmaModules) {
            $participantesIds = json_decode($firmaModules->participantes, true); // Decodificar como array

            if ($participantesIds) {
                $firmaModules->empleados = User::select('id', 'name', 'email')->whereIn('id', $participantesIds)
                    ->get();
            } else {
                $firmaModules->empleados = collect();
            }
        }

        $firmas = FirmaCentroAtencion::with('empleado')->where('modulo_id', $modulo)->where('submodulo_id', $submodulo)->where('id_seguridad', $incidentesSeguridad->id)->get();

        $firma_validacion = FirmaCentroAtencion::where('modulo_id', $modulo)->where('submodulo_id', $submodulo)->where('id_seguridad', $incidentesSeguridad->id)->first();

        $sedes = Sede::getAll();

        $areas = Area::getAll();

        $procesos = Proceso::getAll();

        $subcategorias = SubcategoriaIncidente::get();

        $categorias = CategoriaIncidente::get();

        $participantsSelected = false;

        return view('admin.desk.seguridad.edit', compact('incidentesSeguridad', 'activos', 'empleados', 'sedes', 'areas', 'procesos', 'subcategorias', 'categorias', 'analisis', 'firmaModules', 'firmas', 'aprobadores', 'aprobadoresArray', 'participantsSelected', 'firma_validacion'));
    }

    public function removeUnicodeCharacters($string)
    {
        return preg_replace('/[^\x00-\x7F]/u', '', $string);
    }

    public function updateSeguridad(Request $request, $id_incidente)
    {
        abort_if(Gate::denies('centro_atencion_incidentes_de_seguridad_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $incidentesSeguridad = IncidentesSeguridad::findOrfail(intval($id_incidente));

        $request->validate([
            'titulo' => 'required|string',
            'fecha' => 'required',
            'sede' => 'required',
            'ubicacion' => 'nullable|string',
            'descripcion' => 'required',
            'estatus' => 'required',
        ]);

        $modulo = 1;

        $submodulo = 1;

        $existingRecord = AprobadorSeleccionado::where('modulo_id', $modulo)->where('submodulo_id', $submodulo)->where('user_id', Auth::id())->where('seguridad_id', $incidentesSeguridad->id)->first();

        if ($existingRecord) {
            $existingRecord->delete();
        }

        $aprobadorSeleccionado = new AprobadorSeleccionado();

        // Asignar cada campo individualmente
        $aprobadorSeleccionado->modulo_id = $modulo;
        $aprobadorSeleccionado->submodulo_id = $submodulo;
        $aprobadorSeleccionado->user_id = Auth::id();
        $aprobadorSeleccionado->seguridad_id = $incidentesSeguridad->id;
        $aprobadorSeleccionado->mejoras_id = null;
        $aprobadorSeleccionado->riesgos_id = null;
        $aprobadorSeleccionado->sugerencias_id = null;
        $aprobadorSeleccionado->quejas_id = null;
        $aprobadorSeleccionado->denuncias_id = null;
        $aprobadorSeleccionado->aprobadores = json_encode($request->participantes);

        // Guardar el registro en la base de datos
        $aprobadorSeleccionado->save();

        $empleadoIds = $request->participantes ?? [];

        // Obtener empleados desde la base de datos
        $empleados = User::select('id', 'name', 'email')->whereIn('id', $empleadoIds)->get();

        $status = 'seguridad';

        $organizacion = Organizacion::first();

        $incidentesSeguridad->update([
            'titulo' => $request->titulo,
            'estatus' => $request->estatus,
            'fecha' => $request->fecha,
            'empleado_asignado_id' => $request->empleado_asignado_id,
            'sede' => $request->sede,
            'ubicacion' => $request->ubicacion,
            'descripcion' => $request->descripcion,
            'fecha_cierre' => $request->fecha_cierre,
            'areas_afectados' => $request->areas_afectados,
            'procesos_afectados' => $request->procesos_afectados,
            'activos_afectados' => $request->activos_afectados,
            'empleado_reporto_id' => $incidentesSeguridad->empleado_reporto_id,
            'urgencia' => $request->urgencia,
            'impacto' => $request->impacto,
            'prioridad' => $request->prioridad,
            'comentarios' => $request->comentarios,
            'justificacion' => $request->justificacion,
            'categoria_id' => $request->categoria_id,
            'subcategoria_id' => $request->subcategoria_id,
        ]);

        if ($incidentesSeguridad->estatus === 'Cerrado' || $incidentesSeguridad->estatus === 'No procedente') {

            $existingRecord = AprobadorSeleccionado::where('seguridad_id', $incidentesSeguridad->id)->first();

            if ($existingRecord) {
                $existingRecord->delete();
            }

            $aprobadorSeleccionado = new AprobadorSeleccionado();

            // Asignar cada campo individualmente
            $aprobadorSeleccionado->modulo_id = $modulo;
            $aprobadorSeleccionado->submodulo_id = $submodulo;
            $aprobadorSeleccionado->user_id = Auth::id();
            $aprobadorSeleccionado->seguridad_id = $incidentesSeguridad->id;
            $aprobadorSeleccionado->mejoras_id = null;
            $aprobadorSeleccionado->riesgos_id = null;
            $aprobadorSeleccionado->sugerencias_id = null;
            $aprobadorSeleccionado->quejas_id = null;
            $aprobadorSeleccionado->denuncias_id = null;
            $aprobadorSeleccionado->aprobadores = json_encode($request->participantes);

            // Guardar el registro en la base de datos
            $aprobadorSeleccionado->save();

            foreach ($empleados as $empleado) {
                Mail::to(trim($this->removeUnicodeCharacters($empleado->email)))->queue(new SolicitudAprobacion($empleado, $status, $incidentesSeguridad->id, $organizacion));
            }
        }

        $documento = $incidentesSeguridad->evidencia;

        if ($request->file('evidencia') != null or ! empty($request->file('evidencia'))) {
            foreach ($request->file('evidencia') as $file) {
                $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);

                $name_documento = basename(pathinfo($file->getClientOriginalName(), PATHINFO_BASENAME), '.'.$extension);

                $new_name_documento = 'Seguridad_file_'.$incidentesSeguridad->id.'_'.$name_documento.'.'.$extension;

                $route = 'public/evidencias_seguridad';

                $documento = $new_name_documento;

                $file->storeAs($route, $documento);

                EvidenciasSeguridad::create([
                    'evidencia' => $documento,
                    'id_seguridad' => $incidentesSeguridad->id,
                ]);
            }
        }

        return redirect()->route('admin.desk.index', $id_incidente)->with('success', 'Reporte actualizado');
    }

    public function updateAnalisisSeguridad(Request $request, $id_incidente)
    {
        $analisis_seguridad = AnalisisSeguridad::findOrfail(intval($id_incidente));
        $analisis_seguridad->update([
            'problema_diagrama' => $request->problema_diagrama,
            'problema_porque' => $request->problema_porque,
            'causa_ideas' => $request->causa_ideas,
            'causa_porque' => $request->causa_porque,
            'ideas' => $request->ideas,
            'porque_1' => $request->porque_1,
            'porque_2' => $request->porque_2,
            'porque_3' => $request->porque_3,
            'porque_4' => $request->porque_4,
            'porque_5' => $request->porque_5,
            'control_a' => $request->control_a,
            'control_b' => $request->control_b,
            'proceso_a' => $request->proceso_a,
            'proceso_b' => $request->proceso_b,
            'personas_a' => $request->personas_a,
            'personas_b' => $request->personas_b,
            'tecnologia_a' => $request->tecnologia_a,
            'tecnologia_b' => $request->tecnologia_b,
            'metodos_a' => $request->metodos_a,
            'metodos_b' => $request->metodos_b,
            'ambiente_a' => $request->ambiente_a,
            'ambiente_b' => $request->ambiente_b,
        ]);

        return redirect()->route('admin.desk.seguridad-edit', $analisis_seguridad->seguridad_id)->with('success', 'Reporte actualizado');
    }

    public function archivadoSeguridad(Request $request, $incidente)
    {
        if ($request->ajax()) {
            $incidentesSeguridad = IncidentesSeguridad::findOrfail(intval($incidente));
            $incidentesSeguridad->update([
                'archivado' => IncidentesSeguridad::ARCHIVADO,
            ]);

            return response()->json(['success' => true]);
        }
    }

    public function archivoSeguridad()
    {
        $incidentes_seguridad_archivados = IncidentesSeguridad::getAll()->where('archivado', IncidentesSeguridad::ARCHIVADO);

        return view('admin.desk.seguridad.archivo', compact('incidentes_seguridad_archivados'));
    }

    public function indexRiesgo()
    {
        abort_if(Gate::denies('centro_atencion_riesgos_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $riesgo = RiesgoIdentificado::with('reporto')->where('archivado', false)->get();

        return datatables()->of($riesgo)->toJson();
    }

    public function indexSugerencia()
    {
        abort_if(Gate::denies('centro_atencion_sugerencias_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $riesgo = Sugerencias::with('sugirio')->where('archivado', false)->get();

        return datatables()->of($riesgo)->toJson();
    }

    public function archivadoSugerencia(Request $request, $incidente)
    {
        if ($request->ajax()) {
            $riesgo = Sugerencias::findOrfail(intval($incidente));
            $riesgo->update([
                'archivado' => Sugerencias::ARCHIVADO,
            ]);

            return response()->json(['success' => true]);
        }
    }

    public function archivoSugerencia()
    {
        $sugerencias = Sugerencias::where('archivado', true)->get();

        return view('admin.desk.sugerencias.archivo', compact('sugerencias'));
    }

    public function recuperarArchivadoSugerencia($id)
    {
        $riesgo = Sugerencias::find($id);

        $riesgo->update([
            'archivado' => false,
        ]);

        return redirect()->route('admin.desk.index');
    }

    public function editRiesgos(Request $request, $id_riesgos)
    {
        abort_if(Gate::denies('centro_atencion_riesgos_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $modulo = 1;

        $submodulo = 4;

        $riesgos = RiesgoIdentificado::findOrfail(intval($id_riesgos))->load('evidencias_riesgos');

        $analisis = AnalisisSeguridad::where('formulario', '=', 'riesgo')->where('riesgos_id', intval($id_riesgos))->first();
        if (is_null($analisis)) {
            $analisis = collect();
        }
        $procesos = Proceso::getAll();

        $activos = Activo::getAll();

        $areas = Area::getAll();

        $aprobadores = AprobadorSeleccionado::where('riesgos_id', $riesgos->id)->first();

        $aprobadoresArray = [];

        if ($aprobadores) {
            // Convierte el campo aprobadores de JSON a array
            $aprobadoresArray = json_decode($aprobadores->aprobadores, true);
        }

        $sedes = Sede::getAll();

        $empleados = Empleado::getaltaAll();

        $firmaModules = FirmaModule::where('modulo_id', $modulo)->where('submodulo_id', $submodulo)->first();

        if ($firmaModules) {
            $participantesIds = json_decode($firmaModules->participantes, true); // Decodificar como array

            if ($participantesIds) {
                $firmaModules->empleados = User::whereIn('id', $participantesIds)
                    ->get();
            } else {
                $firmaModules->empleados = collect();
            }
        }

        $participantsSelected = false;

        $firmas = FirmaCentroAtencion::with('empleado')->where('modulo_id', $modulo)->where('submodulo_id', $submodulo)->where('id_riesgos', $riesgos->id)->get();

        $firma_validacion = FirmaCentroAtencion::where('modulo_id', $modulo)->where('submodulo_id', $submodulo)->where('id_riesgos', $riesgos->id)->first();

        return view('admin.desk.riesgos.edit', compact('riesgos', 'procesos', 'empleados', 'areas', 'activos', 'sedes', 'analisis', 'firmaModules', 'firmas', 'aprobadores', 'aprobadoresArray', 'participantsSelected', 'firma_validacion'));
    }

    public function updateRiesgos(Request $request, $id_riesgos)
    {
        abort_if(Gate::denies('centro_atencion_riesgos_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $riesgos = RiesgoIdentificado::findOrfail(intval($id_riesgos));

        $modulo = 1;

        $submodulo = 4;

        $existingRecord = AprobadorSeleccionado::where('modulo_id', $modulo)->where('submodulo_id', $submodulo)->where('user_id', Auth::id())->where('riesgos_id', $riesgos->id)->first();

        // Si existe, eliminarlo
        if ($existingRecord) {
            $existingRecord->delete();
        }

        $aprobadorSeleccionado = new AprobadorSeleccionado();

        // Asignar cada campo individualmente
        $aprobadorSeleccionado->modulo_id = $modulo;
        $aprobadorSeleccionado->submodulo_id = $submodulo;
        $aprobadorSeleccionado->user_id = Auth::id();
        $aprobadorSeleccionado->seguridad_id = null;
        $aprobadorSeleccionado->mejoras_id = null;
        $aprobadorSeleccionado->riesgos_id = $riesgos->id;
        $aprobadorSeleccionado->sugerencias_id = null;
        $aprobadorSeleccionado->quejas_id = null;
        $aprobadorSeleccionado->denuncias_id = null;
        $aprobadorSeleccionado->aprobadores = json_encode($request->participantes);

        $aprobadorSeleccionado->save();

        $empleadoIds = $request->participantes ?? [];

        // Obtener empleados desde la base de datos
        $empleados = User::select('id', 'name', 'email')->whereIn('id', $empleadoIds)->get();

        $status = 'riesgos';

        $organizacion = Organizacion::first();

        $riesgos->update([
            'titulo' => $request->titulo,
            'fecha' => $request->fecha,
            'estatus' => $request->estatus,
            'fecha_cierre' => $request->fecha_cierre,
            'sede' => $request->sede,
            'ubicacion' => $request->ubicacion,
            'descripcion' => $request->descripcion,
            'areas_afectados' => $request->areas_afectados,
            'procesos_afectados' => $request->procesos_afectados,
            'activos_afectados' => $request->activos_afectados,
            'comentarios' => $request->comentarios,
        ]);

        if ($riesgos->estatus === 'cerrado' || $riesgos->estatus === 'cancelado') {

            $existingRecord = AprobadorSeleccionado::where('riesgos_id', $riesgos->id)->first();

            // Si existe, eliminarlo
            if ($existingRecord) {
                $existingRecord->delete();
            }

            $aprobadorSeleccionado = new AprobadorSeleccionado();

            // Asignar cada campo individualmente
            $aprobadorSeleccionado->modulo_id = $modulo;
            $aprobadorSeleccionado->submodulo_id = $submodulo;
            $aprobadorSeleccionado->user_id = Auth::id();
            $aprobadorSeleccionado->seguridad_id = null;
            $aprobadorSeleccionado->mejoras_id = null;
            $aprobadorSeleccionado->riesgos_id = $riesgos->id;
            $aprobadorSeleccionado->sugerencias_id = null;
            $aprobadorSeleccionado->quejas_id = null;
            $aprobadorSeleccionado->denuncias_id = null;
            $aprobadorSeleccionado->aprobadores = json_encode($request->participantes);

            $aprobadorSeleccionado->save();

            foreach ($empleados as $empleado) {
                Mail::to(trim($this->removeUnicodeCharacters($empleado->email)))->queue(new SolicitudAprobacion($empleados, $status, $riesgos->id, $organizacion));
            }
        }

        return redirect()->route('admin.desk.index')->with('success', 'Reporte actualizado');
    }

    public function updateAnalisisReisgos(Request $request, $id_riesgos)
    {
        $analisis_seguridad = AnalisisSeguridad::findOrfail(intval($id_riesgos));
        $analisis_seguridad->update([
            'problema_diagrama' => $request->problema_diagrama,
            'problema_porque' => $request->problema_porque,
            'causa_ideas' => $request->causa_ideas,
            'causa_porque' => $request->causa_porque,
            'ideas' => $request->ideas,
            'porque_1' => $request->porque_1,
            'porque_2' => $request->porque_2,
            'porque_3' => $request->porque_3,
            'porque_4' => $request->porque_4,
            'porque_5' => $request->porque_5,
            'control_a' => $request->control_a,
            'control_b' => $request->control_b,
            'proceso_a' => $request->proceso_a,
            'proceso_b' => $request->proceso_b,
            'personas_a' => $request->personas_a,
            'personas_b' => $request->personas_b,
            'tecnologia_a' => $request->tecnologia_a,
            'tecnologia_b' => $request->tecnologia_b,
            'metodos_a' => $request->metodos_a,
            'metodos_b' => $request->metodos_b,
            'ambiente_a' => $request->ambiente_a,
            'ambiente_b' => $request->ambiente_b,
        ]);

        return redirect()->route('admin.desk.riesgos-edit', $analisis_seguridad->riesgos_id)->with('success', 'Reporte actualizado');
    }

    public function archivadoRiesgo(Request $request, $incidente)
    {
        if ($request->ajax()) {
            $riesgo = RiesgoIdentificado::findOrfail(intval($incidente));
            $riesgo->update([
                'archivado' => true,
            ]);

            return response()->json(['success' => true]);
        }
    }

    public function archivoRiesgo()
    {
        $riesgos = RiesgoIdentificado::getAll()->where('archivado', true);

        return view('admin.desk.riesgos.archivo', compact('riesgos'));
    }

    public function recuperarArchivadoRiesgo($id)
    {
        $riesgo = RiesgoIdentificado::find($id);

        $riesgo->update([
            'archivado' => false,
        ]);

        return redirect()->route('admin.desk.index');
    }

    public function indexQueja()
    {
        abort_if(Gate::denies('centro_atencion_quejas_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $quejas = Quejas::with('quejo')->where('archivado', false)->get();

        return datatables()->of($quejas)->toJson();
    }

    public function editQuejas(Request $request, $id_quejas)
    {
        abort_if(Gate::denies('centro_atencion_quejas_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $modulo = 1;

        $submodulo = 3;

        $quejas = Quejas::findOrfail(intval($id_quejas))->load('evidencias_quejas');

        $procesos = Proceso::getAll();

        $activos = Activo::getAll();

        $analisis = AnalisisSeguridad::where('formulario', '=', 'queja')->where('quejas_id', intval($id_quejas))->first();

        $areas = Area::getAll();

        $sedes = Sede::getAll();

        $empleados = Empleado::getaltaAll();

        $aprobadores = AprobadorSeleccionado::where('quejas_id', $quejas->id)->first();

        $aprobadoresArray = [];

        if ($aprobadores) {
            // Convierte el campo aprobadores de JSON a array
            $aprobadoresArray = json_decode($aprobadores->aprobadores, true);
        }

        $firmaModules = FirmaModule::where('modulo_id', $modulo)->where('submodulo_id', $submodulo)->first();

        if ($firmaModules) {
            $participantesIds = json_decode($firmaModules->participantes, true); // Decodificar como array

            if ($participantesIds) {
                $firmaModules->empleados = User::whereIn('id', $participantesIds)
                    ->get();
            } else {
                $firmaModules->empleados = collect();
            }
        }

        $participantsSelected = false;

        $firmas = FirmaCentroAtencion::with('empleado')->where('modulo_id', $modulo)->where('submodulo_id', $submodulo)->where('id_quejas', $quejas->id)->get();

        $firma_validacion = FirmaCentroAtencion::where('modulo_id', $modulo)->where('submodulo_id', $submodulo)->where('id_quejas', $quejas->id)->first();

        return view('admin.desk.quejas.edit', compact('quejas', 'procesos', 'empleados', 'areas', 'activos', 'sedes', 'analisis', 'firmaModules', 'firmas', 'aprobadores', 'aprobadoresArray', 'participantsSelected', 'firma_validacion'));
    }

    public function updateQuejas(Request $request, $id_quejas)
    {
        abort_if(Gate::denies('centro_atencion_quejas_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $quejas = Quejas::findOrfail(intval($id_quejas));

        $modulo = 1;

        $submodulo = 3;

        $existingRecord = AprobadorSeleccionado::where('modulo_id', $modulo)->where('submodulo_id', $submodulo)->where('user_id', Auth::id())->where('quejas_id', $quejas->id)->first();

        // Si existe, eliminarlo
        if ($existingRecord) {
            $existingRecord->delete();
        }

        $aprobadorSeleccionado = new AprobadorSeleccionado();

        // Asignar cada campo individualmente
        $aprobadorSeleccionado->modulo_id = $modulo;
        $aprobadorSeleccionado->submodulo_id = $submodulo;
        $aprobadorSeleccionado->user_id = Auth::id();
        $aprobadorSeleccionado->seguridad_id = null;
        $aprobadorSeleccionado->mejoras_id = null;
        $aprobadorSeleccionado->riesgos_id = null;
        $aprobadorSeleccionado->sugerencias_id = null;
        $aprobadorSeleccionado->quejas_id = $quejas->id;
        $aprobadorSeleccionado->denuncias_id = null;
        $aprobadorSeleccionado->aprobadores = json_encode($request->participantes);

        $aprobadorSeleccionado->save();

        $empleadoIds = $request->participantes ?? [];

        // Obtener empleados desde la base de datos
        $empleados = User::select('id', 'name', 'email')->whereIn('id', $empleadoIds)->get();

        $status = 'quejas';

        $organizacion = Organizacion::first();

        $quejas->update([
            'titulo' => $request->titulo,
            'estatus' => $request->estatus,
            'fecha' => $request->fecha,
            'sede' => $request->sede,
            'ubicacion' => $request->ubicacion,
            'descripcion' => $request->descripcion,
            'area_quejado' => $request->area_quejado,
            'colaborador_quejado' => $request->colaborador_quejado,
            'proceso_quejado' => $request->proceso_quejado,
            'externo_quejado' => $request->externo_quejado,
            'comentarios' => $request->comentarios,
            'fecha_cierre' => $request->fecha_cierre,

        ]);

        if ($quejas->estatus === 'cerrado' || $quejas->estatus === 'cancelado') {

            $existingRecord = AprobadorSeleccionado::where('quejas_id', $quejas->id)->first();

            // Si existe, eliminarlo
            if ($existingRecord) {
                $existingRecord->delete();
            }

            $aprobadorSeleccionado = new AprobadorSeleccionado();

            // Asignar cada campo individualmente
            $aprobadorSeleccionado->modulo_id = $modulo;
            $aprobadorSeleccionado->submodulo_id = $submodulo;
            $aprobadorSeleccionado->user_id = Auth::id();
            $aprobadorSeleccionado->seguridad_id = null;
            $aprobadorSeleccionado->mejoras_id = null;
            $aprobadorSeleccionado->riesgos_id = null;
            $aprobadorSeleccionado->sugerencias_id = null;
            $aprobadorSeleccionado->quejas_id = $quejas->id;
            $aprobadorSeleccionado->denuncias_id = null;
            $aprobadorSeleccionado->aprobadores = json_encode($request->participantes);

            $aprobadorSeleccionado->save();

            // Enviar correos electrónicos
            foreach ($empleados as $empleado) {
                Mail::to(trim($this->removeUnicodeCharacters($empleado->email)))->queue(new SolicitudAprobacion($empleado, $status, $quejas->id, $organizacion));
            }
        }

        // return redirect()->route('admin.desk.quejas-edit', $id_quejas)->with('success', 'Reporte actualizado');
        return redirect()->route('admin.desk.index')->with('success', 'Reporte actualizado');
    }

    public function updateAnalisisQuejas(Request $request, $id_quejas)
    {
        $analisis_seguridad = AnalisisSeguridad::findOrfail(intval($id_quejas));
        $analisis_seguridad->update([
            'problema_diagrama' => $request->problema_diagrama,
            'problema_porque' => $request->problema_porque,
            'causa_ideas' => $request->causa_ideas,
            'causa_porque' => $request->causa_porque,
            'ideas' => $request->ideas,
            'porque_1' => $request->porque_1,
            'porque_2' => $request->porque_2,
            'porque_3' => $request->porque_3,
            'porque_4' => $request->porque_4,
            'porque_5' => $request->porque_5,
            'control_a' => $request->control_a,
            'control_b' => $request->control_b,
            'proceso_a' => $request->proceso_a,
            'proceso_b' => $request->proceso_b,
            'personas_a' => $request->personas_a,
            'personas_b' => $request->personas_b,
            'tecnologia_a' => $request->tecnologia_a,
            'tecnologia_b' => $request->tecnologia_b,
            'metodos_a' => $request->metodos_a,
            'metodos_b' => $request->metodos_b,
            'ambiente_a' => $request->ambiente_a,
            'ambiente_b' => $request->ambiente_b,
            'fecha_cierre' => $request->fecha_cierre,
        ]);

        return redirect()->route('admin.desk.quejas-edit', $analisis_seguridad->quejas_id)->with('success', 'Reporte actualizado');
    }

    public function archivadoQueja(Request $request, $incidente)
    {

        if ($request->ajax()) {
            $queja = Quejas::findOrfail(intval($incidente));
            $queja->update([
                'archivado' => true,
            ]);

            return response()->json(['success' => true]);
        }
    }

    public function archivoQueja()
    {
        $quejas = Quejas::getAll()->where('archivado', true);

        return view('admin.desk.quejas.archivo', compact('quejas'));
    }

    public function recuperarArchivadoQueja($id)
    {
        $queja = Quejas::find($id);

        $queja->update([
            'archivado' => false,
        ]);

        return redirect()->route('admin.desk.index');
    }

    public function indexDenuncia()
    {
        abort_if(Gate::denies('centro_atencion_denuncias_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $denuncias = Denuncias::with('denuncio', 'denunciado')->where('archivado', false)->get();

        return datatables()->of($denuncias)->toJson();
    }

    public function editDenuncias(Request $request, $id_denuncias)
    {
        abort_if(Gate::denies('centro_atencion_denuncias_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $modulo = 1;

        $submodulo = 6;

        $analisis = AnalisisSeguridad::where('formulario', '=', 'denuncia')->where('denuncias_id', intval($id_denuncias))->first();

        $denuncias = Denuncias::findOrfail(intval($id_denuncias));

        $activos = Activo::getAll();

        $aprobadores = AprobadorSeleccionado::where('denuncias_id', $denuncias->id)->first();

        $aprobadoresArray = [];

        if ($aprobadores) {
            // Convierte el campo aprobadores de JSON a array
            $aprobadoresArray = json_decode($aprobadores->aprobadores, true);
        }

        $empleados = Empleado::getaltaAll();

        $firmaModules = FirmaModule::where('modulo_id', $modulo)->where('submodulo_id', $submodulo)->first();

        if ($firmaModules) {
            $participantesIds = json_decode($firmaModules->participantes, true); // Decodificar como array

            if ($participantesIds) {
                $firmaModules->empleados = User::whereIn('id', $participantesIds)
                    ->get();
            } else {
                $firmaModules->empleados = collect();
            }
        }

        $participantsSelected = false;

        $firmas = FirmaCentroAtencion::with('empleado')->where('modulo_id', $modulo)->where('submodulo_id', $submodulo)->where('id_denuncias', $denuncias->id)->get();

        $firma_validacion = FirmaCentroAtencion::where('modulo_id', $modulo)->where('submodulo_id', $submodulo)->where('id_denuncias', $denuncias->id)->first();

        return view('admin.desk.denuncias.edit', compact('denuncias', 'activos', 'empleados', 'analisis', 'firmaModules', 'firmas', 'aprobadores', 'aprobadoresArray', 'participantsSelected', 'firma_validacion'));
    }

    public function updateDenuncias(Request $request, $id_denuncias)
    {
        abort_if(Gate::denies('centro_atencion_denuncias_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $denuncias = Denuncias::findOrfail(intval($id_denuncias));

        $modulo = 1;

        $submodulo = 6;

        $existingRecord = AprobadorSeleccionado::where('modulo_id', $modulo)->where('submodulo_id', $submodulo)->where('user_id', Auth::id())->where('denuncias_id', $denuncias->id)->first();

        // Si existe, eliminarlo
        if ($existingRecord) {
            $existingRecord->delete();
        }

        $aprobadorSeleccionado = new AprobadorSeleccionado();

        // Asignar cada campo individualmente
        $aprobadorSeleccionado->modulo_id = $modulo;
        $aprobadorSeleccionado->submodulo_id = $submodulo;
        $aprobadorSeleccionado->user_id = Auth::id();
        $aprobadorSeleccionado->seguridad_id = null;
        $aprobadorSeleccionado->mejoras_id = null;
        $aprobadorSeleccionado->riesgos_id = null;
        $aprobadorSeleccionado->sugerencias_id = null;
        $aprobadorSeleccionado->quejas_id = null;
        $aprobadorSeleccionado->denuncias_id = $denuncias->id;
        $aprobadorSeleccionado->aprobadores = json_encode($request->participantes);

        $aprobadorSeleccionado->save();

        $empleadoIds = $request->participantes ?? [];

        // Obtener empleados desde la base de datos
        $empleados = User::select('id', 'name', 'email')->whereIn('id', $empleadoIds)->get();

        $status = 'denuncias';

        $organizacion = Organizacion::first();

        $denuncias->update([
            'anonimo' => $request->anonimo,
            'descripcion' => $request->descripcion,
            'evidencia' => $request->evidencia,
            'denunciado' => $request->denunciado,
            'area_denunciado' => $request->area_denunciado,
            'tipo' => $request->tipo,
            'estatus' => $request->estatus,
            'fecha_cierre' => $request->fecha_cierre,
        ]);

        if ($denuncias->estatus === 'cerrado' || $denuncias->estatus === 'cancelado') {

            $existingRecord = AprobadorSeleccionado::where('denuncias_id', $denuncias->id)->first();

            // Si existe, eliminarlo
            if ($existingRecord) {
                $existingRecord->delete();
            }

            $aprobadorSeleccionado = new AprobadorSeleccionado();

            // Asignar cada campo individualmente
            $aprobadorSeleccionado->modulo_id = $modulo;
            $aprobadorSeleccionado->submodulo_id = $submodulo;
            $aprobadorSeleccionado->user_id = Auth::id();
            $aprobadorSeleccionado->seguridad_id = null;
            $aprobadorSeleccionado->mejoras_id = null;
            $aprobadorSeleccionado->riesgos_id = null;
            $aprobadorSeleccionado->sugerencias_id = null;
            $aprobadorSeleccionado->quejas_id = null;
            $aprobadorSeleccionado->denuncias_id = $denuncias->id;
            $aprobadorSeleccionado->aprobadores = json_encode($request->participantes);

            $aprobadorSeleccionado->save();

            // Enviar correos electrónicos
            foreach ($empleados as $empleado) {
                Mail::to(trim($this->removeUnicodeCharacters($empleado->email)))->queue(new SolicitudAprobacion($empleado, $status, $denuncias->id, $organizacion));
            }
        }

        return redirect()->route('admin.desk.index')->with('success', 'Reporte actualizado');
    }

    public function updateAnalisisDenuncias(Request $request, $id_denuncias)
    {
        $analisis_seguridad = AnalisisSeguridad::findOrfail(intval($id_denuncias));
        $analisis_seguridad->update([
            'problema_diagrama' => $request->problema_diagrama,
            'problema_porque' => $request->problema_porque,
            'causa_ideas' => $request->causa_ideas,
            'causa_porque' => $request->causa_porque,
            'ideas' => $request->ideas,
            'porque_1' => $request->porque_1,
            'porque_2' => $request->porque_2,
            'porque_3' => $request->porque_3,
            'porque_4' => $request->porque_4,
            'porque_5' => $request->porque_5,
            'control_a' => $request->control_a,
            'control_b' => $request->control_b,
            'proceso_a' => $request->proceso_a,
            'proceso_b' => $request->proceso_b,
            'personas_a' => $request->personas_a,
            'personas_b' => $request->personas_b,
            'tecnologia_a' => $request->tecnologia_a,
            'tecnologia_b' => $request->tecnologia_b,
            'metodos_a' => $request->metodos_a,
            'metodos_b' => $request->metodos_b,
            'ambiente_a' => $request->ambiente_a,
            'ambiente_b' => $request->ambiente_b,
        ]);

        // return redirect()->route('admin.desk.denuncias-edit', $analisis_seguridad->denuncias_id)->with('success', 'Reporte actualizado');
        return redirect()->route('admin.desk.index')->with('success', 'Reporte actualizado');
    }

    public function archivadoDenuncia(Request $request, $incidente)
    {
        if ($request->ajax()) {
            $denuncia = Denuncias::findOrfail(intval($incidente));
            $denuncia->update([
                'archivado' => true,
            ]);

            return response()->json(['success' => true]);
        }
    }

    public function archivoDenuncia()
    {
        $denuncias = Denuncias::where('archivado', true)->get();

        return view('admin.desk.denuncias.archivo', compact('denuncias'));
    }

    public function recuperarArchivadoDenuncia($id)
    {
        $queja = Denuncias::find($id);
        $queja->update([
            'archivado' => false,
        ]);

        return redirect()->route('admin.desk.index');
    }

    public function indexMejora()
    {
        abort_if(Gate::denies('centro_atencion_mejoras_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mejoras = Mejoras::with('mejoro')->where('archivado', false)->get();

        return datatables()->of($mejoras)->toJson();
    }

    public function editMejoras(Request $request, $id_mejoras)
    {
        abort_if(Gate::denies('centro_atencion_mejoras_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $modulo = 1;

        $submodulo = 2;

        $mejoras = Mejoras::findOrfail(intval($id_mejoras));

        $activos = Activo::getAll();

        $empleados = Empleado::getaltaAll();

        $aprobadores = AprobadorSeleccionado::where('mejoras_id', $mejoras->id)->first();

        $aprobadoresArray = [];

        if ($aprobadores) {
            // Convierte el campo aprobadores de JSON a array
            $aprobadoresArray = json_decode($aprobadores->aprobadores, true);
        }

        $areas = Area::getAll();

        $procesos = Proceso::getAll();

        $analisis = AnalisisSeguridad::where('formulario', '=', 'mejora')->where('mejoras_id', intval($id_mejoras))->first();

        $firmaModules = FirmaModule::where('modulo_id', $modulo)->where('submodulo_id', $submodulo)->first();

        if ($firmaModules) {
            $participantesIds = json_decode($firmaModules->participantes, true); // Decodificar como array

            if ($participantesIds) {
                $firmaModules->empleados = User::whereIn('id', $participantesIds)
                    ->get();
            } else {
                $firmaModules->empleados = collect();
            }
        }

        $participantsSelected = false;

        $firmas = FirmaCentroAtencion::with('empleado')->where('modulo_id', $modulo)->where('submodulo_id', $submodulo)->where('id_mejoras', $mejoras->id)->get();

        $firma_validacion = FirmaCentroAtencion::where('modulo_id', $modulo)->where('submodulo_id', $submodulo)->where('id_mejoras', $mejoras->id)->first();

        return view('admin.desk.mejoras.edit', compact('mejoras', 'activos', 'empleados', 'areas', 'procesos', 'analisis', 'firmaModules', 'firmas', 'aprobadores', 'aprobadoresArray', 'participantsSelected', 'firma_validacion'));
    }

    public function updateMejoras(Request $request, $id_mejoras)
    {
        abort_if(Gate::denies('centro_atencion_mejoras_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'area_mejora' => 'nullable|string',
            'proceso_mejora' => 'nullable|string',
            'titulo' => 'required',
            'tipo' => 'required',
            'descripcion' => 'required',
            'beneficios' => 'required',
        ]);

        $modulo = 1;

        $submodulo = 2;

        $mejoras = Mejoras::findOrfail(intval($id_mejoras));

        $existingRecord = AprobadorSeleccionado::where('modulo_id', $modulo)->where('submodulo_id', $submodulo)->where('user_id', Auth::id())->where('mejoras_id', $mejoras->id)->first();

        // Si existe, eliminarlo
        if ($existingRecord) {
            $existingRecord->delete();
        }

        $aprobadorSeleccionado = new AprobadorSeleccionado();

        // Asignar cada campo individualmente
        $aprobadorSeleccionado->modulo_id = $modulo;
        $aprobadorSeleccionado->submodulo_id = $submodulo;
        $aprobadorSeleccionado->user_id = Auth::id();
        $aprobadorSeleccionado->seguridad_id = null;
        $aprobadorSeleccionado->mejoras_id = $mejoras->id;
        $aprobadorSeleccionado->riesgos_id = null;
        $aprobadorSeleccionado->sugerencias_id = null;
        $aprobadorSeleccionado->quejas_id = null;
        $aprobadorSeleccionado->denuncias_id = null;
        $aprobadorSeleccionado->aprobadores = json_encode($request->participantes);

        $aprobadorSeleccionado->save();

        $empleadoIds = $request->participantes ?? [];

        // Obtener empleados desde la base de datos
        $empleados = User::select('id', 'name', 'email')->whereIn('id', $empleadoIds)->get();

        $status = 'mejoras';

        $organizacion = Organizacion::first();

        $mejoras->update([
            'estatus' => $request->estatus,
            'fecha_cierre' => $request->fecha_cierre,
            'descripcion' => $request->descripcion,
            'beneficios' => $request->beneficios,
            'titulo' => $request->titulo,
            'area_mejora' => $request->area_mejora,
            'proceso_mejora' => $request->proceso_mejora,
            'tipo' => $request->tipo,
            'otro' => $request->otro,
        ]);

        if ($mejoras->estatus === 'cerrado' || $mejoras->estatus === 'cancelado') {
            $existingRecord = AprobadorSeleccionado::where('mejoras_id', $mejoras->id)->first();

            // Si existe, eliminarlo
            if ($existingRecord) {
                $existingRecord->delete();
            }

            $aprobadorSeleccionado = new AprobadorSeleccionado();

            // Asignar cada campo individualmente
            $aprobadorSeleccionado->modulo_id = $modulo;
            $aprobadorSeleccionado->submodulo_id = $submodulo;
            $aprobadorSeleccionado->user_id = Auth::id();
            $aprobadorSeleccionado->seguridad_id = null;
            $aprobadorSeleccionado->mejoras_id = $mejoras->id;
            $aprobadorSeleccionado->riesgos_id = null;
            $aprobadorSeleccionado->sugerencias_id = null;
            $aprobadorSeleccionado->quejas_id = null;
            $aprobadorSeleccionado->denuncias_id = null;
            $aprobadorSeleccionado->aprobadores = json_encode($request->participantes);

            $aprobadorSeleccionado->save();

            // Enviar correos electrónicos
            foreach ($empleados as $empleado) {
                Mail::to(trim($this->removeUnicodeCharacters($empleado->email)))->queue(new SolicitudAprobacion($empleado, $status, $mejoras->id, $organizacion));
            }
        }

        // return redirect()->route('admin.desk.mejoras-edit', $id_mejoras)->with('success', 'Reporte actualizado');
        return redirect()->route('admin.desk.index')->with('success', 'Reporte actualizado');
    }

    public function updateAnalisisMejoras(Request $request, $id_mejoras)
    {

        $analisis_seguridad = AnalisisSeguridad::findOrfail(intval($id_mejoras));
        $analisis_seguridad->update([
            'problema_diagrama' => $request->problema_diagrama,
            'problema_porque' => $request->problema_porque,
            'causa_ideas' => $request->causa_ideas,
            'causa_porque' => $request->causa_porque,
            'ideas' => $request->ideas,
            'porque_1' => $request->porque_1,
            'porque_2' => $request->porque_2,
            'porque_3' => $request->porque_3,
            'porque_4' => $request->porque_4,
            'porque_5' => $request->porque_5,
            'control_a' => $request->control_a,
            'control_b' => $request->control_b,
            'proceso_a' => $request->proceso_a,
            'proceso_b' => $request->proceso_b,
            'personas_a' => $request->personas_a,
            'personas_b' => $request->personas_b,
            'tecnologia_a' => $request->tecnologia_a,
            'tecnologia_b' => $request->tecnologia_b,
            'metodos_a' => $request->metodos_a,
            'metodos_b' => $request->metodos_b,
            'ambiente_a' => $request->ambiente_a,
            'ambiente_b' => $request->ambiente_b,
            'metodo' => $request->metodo,
        ]);

        return redirect()->route('admin.desk.mejoras-edit', $analisis_seguridad->mejoras_id)->with('success', 'Reporte actualizado');
    }

    public function archivadoMejora(Request $request, $incidente)
    {
        if ($request->ajax()) {
            $mejora = Mejoras::findOrfail(intval($incidente));
            $mejora->update([
                'archivado' => true,
            ]);

            return response()->json(['success' => true]);
        }
    }

    public function archivoMejora()
    {
        $mejoras = Mejoras::where('archivado', true)->get();

        return view('admin.desk.mejoras.archivo', compact('mejoras'));
    }

    public function recuperarArchivadoMejora($id)
    {
        $mejora = Mejoras::find($id);
        $mejora->update([
            'archivado' => false,
        ]);

        return redirect()->route('admin.desk.index');
    }

    public function editSugerencias(Request $request, $id_sugerencias)
    {
        abort_if(Gate::denies('centro_atencion_sugerencias_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $modulo = 1;

        $submodulo = 5;

        $sugerencias = Sugerencias::findOrfail(intval($id_sugerencias));

        $activos = Activo::getAll();

        $empleados = Empleado::getaltaAll();

        $areas = Area::getAll();

        $procesos = Proceso::getAll();

        $aprobadores = AprobadorSeleccionado::where('sugerencias_id', $sugerencias->id)->first();

        $aprobadoresArray = [];

        if ($aprobadores) {
            // Convierte el campo aprobadores de JSON a array
            $aprobadoresArray = json_decode($aprobadores->aprobadores, true);
        }

        $analisis = AnalisisSeguridad::where('formulario', '=', 'sugerencia')->where('sugerencias_id', intval($id_sugerencias))->first();

        $firmaModules = FirmaModule::where('modulo_id', $modulo)->where('submodulo_id', $submodulo)->first();

        if ($firmaModules) {
            $participantesIds = json_decode($firmaModules->participantes, true); // Decodificar como array

            if ($participantesIds) {
                $firmaModules->empleados = User::whereIn('id', $participantesIds)
                    ->get();
            } else {
                $firmaModules->empleados = collect();
            }
        }

        $participantsSelected = false;

        $firmas = FirmaCentroAtencion::with('empleado')->where('modulo_id', $modulo)->where('submodulo_id', $submodulo)->where('id_sugerencias', $sugerencias->id)->get();

        $firma_validacion = FirmaCentroAtencion::where('modulo_id', $modulo)->where('submodulo_id', $submodulo)->where('id_sugerencias', $sugerencias->id)->first();

        return view('admin.desk.sugerencias.edit', compact('sugerencias', 'activos', 'empleados', 'areas', 'procesos', 'analisis', 'firmaModules', 'firmas', 'aprobadores', 'aprobadoresArray', 'participantsSelected', 'firma_validacion'));
    }

    public function updateSugerencias(Request $request, $id_sugerencias)
    {
        abort_if(Gate::denies('centro_atencion_sugerencias_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sugerencias = Sugerencias::findOrfail(intval($id_sugerencias));

        $modulo = 1;

        $submodulo = 5;

        $existingRecord = AprobadorSeleccionado::where('modulo_id', $modulo)->where('submodulo_id', $submodulo)->where('user_id', Auth::id())->where('sugerencias_id', $sugerencias->id)->first();

        // Si existe, eliminarlo
        if ($existingRecord) {
            $existingRecord->delete();
        }

        $aprobadorSeleccionado = new AprobadorSeleccionado();

        // Asignar cada campo individualmente
        $aprobadorSeleccionado->modulo_id = $modulo;
        $aprobadorSeleccionado->submodulo_id = $submodulo;
        $aprobadorSeleccionado->user_id = Auth::id();
        $aprobadorSeleccionado->seguridad_id = null;
        $aprobadorSeleccionado->mejoras_id = null;
        $aprobadorSeleccionado->riesgos_id = null;
        $aprobadorSeleccionado->sugerencias_id = $sugerencias->id;
        $aprobadorSeleccionado->quejas_id = null;
        $aprobadorSeleccionado->denuncias_id = null;
        $aprobadorSeleccionado->aprobadores = json_encode($request->participantes);

        $aprobadorSeleccionado->save();

        $empleadoIds = $request->participantes ?? [];

        // Obtener empleados desde la base de datos
        $empleados = User::select('id', 'name', 'email')->whereIn('id', $empleadoIds)->get();

        $status = 'sugerencias';

        $organizacion = Organizacion::first();

        $sugerencias->update([
            'area_sugerencias' => $request->area_sugerencias,
            'proceso_sugerencias' => $request->proceso_sugerencias,
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'estatus' => $request->estatus,
            'fecha_cierre' => $request->fecha_cierre,
        ]);

        if ($sugerencias->estatus === 'cerrado' || $sugerencias->estatus === 'cancelado') {

            $existingRecord = AprobadorSeleccionado::where('sugerencias_id', $sugerencias->id)->first();

            // Si existe, eliminarlo
            if ($existingRecord) {
                $existingRecord->delete();
            }

            $aprobadorSeleccionado = new AprobadorSeleccionado();

            // Asignar cada campo individualmente
            $aprobadorSeleccionado->modulo_id = $modulo;
            $aprobadorSeleccionado->submodulo_id = $submodulo;
            $aprobadorSeleccionado->user_id = Auth::id();
            $aprobadorSeleccionado->seguridad_id = null;
            $aprobadorSeleccionado->mejoras_id = null;
            $aprobadorSeleccionado->riesgos_id = null;
            $aprobadorSeleccionado->sugerencias_id = $sugerencias->id;
            $aprobadorSeleccionado->quejas_id = null;
            $aprobadorSeleccionado->denuncias_id = null;
            $aprobadorSeleccionado->aprobadores = json_encode($request->participantes);

            $aprobadorSeleccionado->save();

            // Enviar correos electrónicos
            foreach ($empleados as $empleado) {
                Mail::to(trim($this->removeUnicodeCharacters($empleado->email)))->queue(new SolicitudAprobacion($empleado, $status, $sugerencias->id, $organizacion));
            }
        }

        // return redirect()->route('admin.desk.sugerencias-edit', $id_sugerencias)->with('success', 'Reporte actualizado');
        return redirect()->route('admin.desk.index')->with('success', 'Reporte actualizado');
    }

    public function updateAnalisisSugerencias(Request $request, $id_sugerencias)
    {
        $analisis_seguridad = AnalisisSeguridad::findOrfail(intval($id_sugerencias));
        $analisis_seguridad->update([
            'problema_diagrama' => $request->problema_diagrama,
            'problema_porque' => $request->problema_porque,
            'causa_ideas' => $request->causa_ideas,
            'causa_porque' => $request->causa_porque,
            'ideas' => $request->ideas,
            'porque_1' => $request->porque_1,
            'porque_2' => $request->porque_2,
            'porque_3' => $request->porque_3,
            'porque_4' => $request->porque_4,
            'porque_5' => $request->porque_5,
            'control_a' => $request->control_a,
            'control_b' => $request->control_b,
            'proceso_a' => $request->proceso_a,
            'proceso_b' => $request->proceso_b,
            'personas_a' => $request->personas_a,
            'personas_b' => $request->personas_b,
            'tecnologia_a' => $request->tecnologia_a,
            'tecnologia_b' => $request->tecnologia_b,
            'metodos_a' => $request->metodos_a,
            'metodos_b' => $request->metodos_b,
            'ambiente_a' => $request->ambiente_a,
            'ambiente_b' => $request->ambiente_b,
        ]);

        return redirect()->route('admin.desk.sugerencias-edit', $analisis_seguridad->sugerencias_id)->with('success', 'Reporte actualizado');
    }

    public function recuperarArchivadoSeguridad($id)
    {
        $recurso = IncidentesSeguridad::find($id);
        $recurso->update([
            'archivado' => IncidentesSeguridad::NO_ARCHIVADO,
        ]);

        return redirect()->route('admin.desk.index');
    }

    public function quejasClientes()
    {
        abort_if(Gate::denies('centro_atencion_quejas_clientes_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $areas = Area::getAll();

        $procesos = Proceso::getAll();

        $activos = Activo::getAll();

        $empleados = Empleado::getaltaAll();

        $clientes = TimesheetCliente::getAll();

        $proyectos = TimesheetProyecto::getAll();

        return view('admin.desk.clientes.quejasclientes', compact('areas', 'procesos', 'empleados', 'activos', 'clientes', 'proyectos'));
    }

    public function indexQuejasClientes()
    {
        abort_if(Gate::denies('centro_atencion_quejas_clientes_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $quejasClientes = QuejasCliente::with('evidencias_quejas', 'planes', 'cierre_evidencias', 'cliente', 'proyectos')->where('archivado', false)->get();

        return datatables()->of($quejasClientes)->toJson();
    }

    public function storeQuejasClientes(Request $request)
    {
        abort_if(Gate::denies('centro_atencion_quejas_clientes_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'cliente_id' => 'required',
            'proyectos_id' => 'required',
            'nombre' => 'required',
            'titulo' => 'required',
            'fecha' => 'required',
            'descripcion' => 'required',
            'area_quejado' => 'required',
            'solucion_requerida_cliente' => 'required',
            'correo_cliente' => 'required',
            'correo' => 'required',
            'canal' => 'required',
        ]);

        $correo_cliente = intval($request->correo_cliente) == 1 ? true : false;
        // if ($correo_cliente) {
        //     $request->validate([
        //         'correo' => 'required',
        //     ]);
        // }

        $quejasClientes = QuejasCliente::create([
            'cliente_id' => $request->cliente_id,
            'proyectos_id' => $request->proyectos_id,
            'nombre' => $request->nombre,
            'puesto' => $request->puesto,
            'telefono' => $request->telefono,
            'correo' => $request->correo,
            'area_quejado' => $request->area_quejado,
            'colaborador_quejado' => $request->colaborador_quejado,
            'proceso_quejado' => $request->proceso_quejado,
            'otro_quejado' => $request->otro_quejado,
            'titulo' => $request->titulo,
            'fecha' => $request->fecha,
            'ubicacion' => $request->ubicacion,
            'descripcion' => $request->descripcion,
            'estatus' => 'Sin atender',
            'comentarios' => $request->comentarios,
            'canal' => $request->canal,
            'otro_canal' => $request->otro_canal,
            'solucion_requerida_cliente' => $request->solucion_requerida_cliente,
            'empleado_reporto_id' => User::getCurrentUser()->empleado->id,
            'correo_cliente' => $correo_cliente,

        ]);

        AnalisisQuejasClientes::create([
            'quejas_clientes_id' => $quejasClientes->id,
            'formulario' => 'quejaCliente',
        ]);

        $image = null;

        if ($request->file('evidencia') != null or ! empty($request->file('evidencia'))) {
            foreach ($request->file('evidencia') as $file) {
                $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);

                $name_image = basename(pathinfo($file->getClientOriginalName(), PATHINFO_BASENAME), '.'.$extension);

                $new_name_image = 'Queja_file_'.$quejasClientes->id.'_'.$name_image.'.'.$extension;

                $route = 'public/evidencias_quejas_clientes';

                $image = $new_name_image;

                $file->storeAs($route, $image);

                EvidenciaQuejasClientes::create([
                    'evidencia' => $image,
                    'quejas_clientes_id' => $quejasClientes->id,
                ]);
            }
        }

        if ($correo_cliente) {
            Mail::to(removeUnicodeCharacters($quejasClientes->correo))->cc(removeUnicodeCharacters($quejasClientes->registro->email))->queue(new SeguimientoQuejaClienteEmail($quejasClientes));
        }

        return redirect()->route('admin.desk.index')->with('success', 'Reporte generado');
    }

    public function editQuejasClientes(Request $request, $id_quejas)
    {
        abort_if(Gate::denies('centro_atencion_quejas_cliente_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $quejasClientes = QuejasCliente::findOrfail(intval($id_quejas))->load('evidencias_quejas', 'planes', 'cierre_evidencias', 'cliente', 'proyectos');

        $procesos = Proceso::getAll();

        $activos = Activo::getAll();

        $analisis = AnalisisQuejasClientes::where('formulario', '=', 'quejaCliente')->where('quejas_clientes_id', intval($id_quejas))->first();

        $areas = Area::getAll();

        $empleados = Empleado::orderBy('name')->get();

        $clientes = TimesheetCliente::getAll();

        $proyectos = TimesheetProyecto::getAll();

        $cierre = EvidenciasQuejasClientesCerrado::where('quejas_clientes_id', '=', $quejasClientes->id)->get();

        $evidenciaCreate = EvidenciaQuejasClientes::where('quejas_clientes_id', '=', $quejasClientes->id)->get();

        return view('admin.desk.clientes.edit', compact('id_quejas', 'evidenciaCreate', 'cierre', 'clientes', 'proyectos', 'quejasClientes', 'procesos', 'empleados', 'areas', 'activos', 'analisis'));
    }

    public function updateQuejasClientes(Request $request, $id_quejas)
    {
        abort_if(Gate::denies('centro_atencion_quejas_cliente_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $queja_procedente = intval($request->queja_procedente) == 1 ? true : false;
        if ($queja_procedente) {
            $request->validate([
                'urgencia' => 'required',
                'impacto' => 'required',
            ]);
        }

        $quejasClientes = QuejasCliente::findOrfail(intval($id_quejas));
        $queja_procedente = intval($request->queja_procedente ? $request->queja_procedente : $quejasClientes->queja_procedente) == 1 ? true : false;
        $realizar_accion = intval($request->realizar_accion ? $request->realizar_accion : $quejasClientes->realizar_accion) == 1 ? true : false;
        $desea_levantar_ac = intval($request->desea_levantar_ac ? $request->desea_levantar_ac : $quejasClientes->desea_levantar_ac) == 1 ? true : false;
        $notificar_responsable = intval($request->notificar_responsable ? $request->notificar_responsable : $quejasClientes->notificar_responsable) == 1 ? true : false;
        $notificar_registro_queja = intval($request->notificar_registro_queja ? $request->notificar_registro_queja : $quejasClientes->notificar_registro_queja) == 1 ? true : false;
        $cumplio_ac_responsable = intval($request->cumplio_ac_responsable ? $request->cumplio_ac_responsable : $quejasClientes->cumplio_ac_responsable) == 1 ? true : false;
        $conforme_solucion = intval($request->conforme_solucion ? $request->conforme_solucion : $quejasClientes->conforme_solucion) == 1 ? true : false;
        $cumplio_fecha = intval($request->cumplio_fecha ? $request->cumplio_fecha : $quejasClientes->cumplio_fecha) == 1 ? true : false;
        $cerrar_ticket = intval($request->cerrar_ticket ? $request->cerrar_ticket : $quejasClientes->cerrar_ticket) == 1 ? true : false;
        $email_realizara_accion_inmediata = intval($request->email_realizara_accion_inmediata ? $request->email_realizara_accion_inmediata : $quejasClientes->email_realizara_accion_inmediata) == 1 ? true : false;
        //if ($desea_levantar_ac) {
        //     $request->validate([
        //        'responsable_sgi_id' => 'required',
        //    ]);
        //}
        $notificar_atencion_queja_no_aprobada = intval($request->notificar_atencion_queja_no_aprobada) == 1 ? true : false;

        $quejasClientes->update([
            'cliente_id' => $request->cliente_id ? $request->cliente_id : $quejasClientes->cliente_id,
            'proyectos_id' => $request->proyectos_id ? $request->proyectos_id : $quejasClientes->proyectos_id,
            'nombre' => $request->nombre ? $request->nombre : $quejasClientes->nombre,
            'puesto' => $request->puesto ? $request->puesto : $quejasClientes->puesto,
            'telefono' => $request->telefono ? $request->telefono : $quejasClientes->telefono,
            'correo' => $request->correo ? $request->correo : $quejasClientes->correo,
            'area_quejado' => $request->area_quejado ? $request->area_quejado : $quejasClientes->area_quejado,
            'colaborador_quejado' => $request->colaborador_quejado ? $request->colaborador_quejado : $quejasClientes->colaborador_quejado,
            'proceso_quejado' => $request->proceso_quejado ? $request->proceso_quejado : $quejasClientes->proceso_quejado,
            'otro_quejado' => $request->otro_quejado ? $request->otro_quejado : $quejasClientes->otro_quejado,
            'titulo' => $request->titulo ? $request->titulo : $quejasClientes->titulo,
            'fecha_cierre' => $request->fecha_cierre ? $request->fecha_cierre : $quejasClientes->fecha_cierre,
            'ubicacion' => $request->ubicacion ? $request->ubicacion : $quejasClientes->ubicacion,
            'descripcion' => $request->descripcion ? $request->descripcion : $quejasClientes->descripcion,
            'estatus' => 'En curso' ? 'En curso' : $quejasClientes->estatus,
            'comentarios' => $request->comentarios ? $request->comentarios : $quejasClientes->comentarios,
            'canal' => $request->canal ? $request->canal : $quejasClientes->canal,
            'otro_canal' => $request->otro_canal ? $request->otro_canal : $quejasClientes->otro_canal,
            'solucion_requerida_cliente' => $request->solucion_requerida_cliente ? $request->solucion_requerida_cliente : $quejasClientes->solucion_requerida_cliente,
            'urgencia' => $request->urgencia ? $request->urgencia : $quejasClientes->urgencia,
            'impacto' => $request->impacto ? $request->impacto : $quejasClientes->impacto,
            'prioridad' => $request->prioridad ? $request->prioridad : $quejasClientes->prioridad,
            'categoria_queja' => $request->categoria_queja ? $request->categoria_queja : $quejasClientes->categoria_queja,
            'otro_categoria' => $request->otro_categoria ? $request->otro_categoria : $quejasClientes->otro_categoria,
            'queja_procedente' => $queja_procedente,
            'porque_procedente' => $request->porque_procedente ? $request->porque_procedente : $quejasClientes->porque_procedente,
            'realizar_accion' => $realizar_accion,
            'cual_accion' => $request->cual_accion ? $request->cual_accion : $quejasClientes->cual_accion,
            'desea_levantar_ac' => $desea_levantar_ac,
            'acciones_tomara_responsable' => $request->acciones_tomara_responsable ? $request->acciones_tomara_responsable : $quejasClientes->acciones_tomara_responsable,
            'fecha_limite' => $request->fecha_limite ? $request->fecha_limite : $quejasClientes->fecha_limite,
            'comentarios_atencion' => $request->comentarios_atencion ? $request->comentarios_atencion : $quejasClientes->comentarios_atencion,
            'responsable_sgi_id' => $request->responsable_sgi_id ? $request->responsable_sgi_id : $quejasClientes->responsable_sgi_id,
            'responsable_atencion_queja_id' => $request->responsable_atencion_queja_id ? $request->responsable_atencion_queja_id : $quejasClientes->responsable_atencion_queja_id,
            'porque_procedente' => $request->porque_procedente ? $request->porque_procedente : $quejasClientes->porque_procedente,
            'cumplio_ac_responsable' => $cumplio_ac_responsable,
            'porque_no_cumplio_responsable' => $request->porque_no_cumplio_responsable ? $request->porque_no_cumplio_responsable : $quejasClientes->porque_no_cumplio_responsable,
            'conforme_solucion' => $conforme_solucion,
            'cerrar_ticket' => $cerrar_ticket,
            'cumplio_fecha' => $cumplio_fecha,
            'notificar_responsable' => $notificar_responsable,
            'notificar_registro_queja' => $notificar_registro_queja,
            'porque_no_cierre_ticket' => $request->porque_no_cierre_ticket ? $request->porque_no_cierre_ticket : $quejasClientes->porque_no_cierre_ticket,
            'notificar_atencion_queja_no_aprobada' => $notificar_atencion_queja_no_aprobada,
        ]);

        $documento = null;

        if ($request->file('evidencia') != null or ! empty($request->file('evidencia'))) {
            foreach ($request->file('evidencia') as $file) {
                $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);

                $name_documento = basename(pathinfo($file->getClientOriginalName(), PATHINFO_BASENAME), '.'.$extension);

                $new_name_documento = 'Queja_file_'.$quejasClientes->id.'_'.$name_documento.'.'.$extension;

                $route = 'public/evidencias_quejas_clientes';

                $documento = $new_name_documento;

                $file->storeAs($route, $documento);

                EvidenciaQuejasClientes::create([
                    'evidencia' => $documento,
                    'quejas_clientes_id' => $quejasClientes->id,
                ]);
            }
        }

        $image = null;

        if ($request->file('cierre') != null or ! empty($request->file('cierre'))) {
            foreach ($request->file('cierre') as $file) {
                $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);

                $name_image = basename(pathinfo($file->getClientOriginalName(), PATHINFO_BASENAME), '.'.$extension);

                $new_name_image = 'Queja_file_'.$quejasClientes->id.'_'.$name_image.'.'.$extension;

                $route = 'public/evidencias_quejas_clientes_cerrado';

                $image = $new_name_image;

                $file->storeAs($route, $image);

                EvidenciasQuejasClientesCerrado::create([
                    'cierre' => $image,
                    'quejas_clientes_id' => $quejasClientes->id,
                ]);
            }
        }

        if ($queja_procedente == false) {
            $quejasClientes->update([
                'estatus' => 'No procedente',
            ]);
        }

        if ($cerrar_ticket) {
            $quejasClientes->update([
                'estatus' => 'Cerrado',
                'fecha_cierre' => now(),
            ]);
        }

        if ($notificar_atencion_queja_no_aprobada) {
            if ($cerrar_ticket == false) {
                if (! $quejasClientes->email_env_resolucion_rechazada) {
                    if ($quejasClientes->registro != null && $quejasClientes->responsableAtencion != null) {
                        $quejasClientes->update([
                            'email_env_resolucion_rechazada' => true,
                        ]);
                        Mail::to(removeUnicodeCharacters($quejasClientes->responsableAtencion->email))->cc(removeUnicodeCharacters($quejasClientes->registro->email))->queue(new ResolucionQuejaRechazadaEmail($quejasClientes));
                    }
                }
            }
        }

        if ($notificar_atencion_queja_no_aprobada) {
            if ($cerrar_ticket) {
                if (! $quejasClientes->email_env_resolucion_aprobada) {
                    if ($quejasClientes->registro != null && $quejasClientes->responsableAtencion != null) {
                        $quejasClientes->update([
                            'email_env_resolucion_aprobada' => true,
                        ]);
                        Mail::to(removeUnicodeCharacters($quejasClientes->responsableAtencion->email))->cc(removeUnicodeCharacters($quejasClientes->registro->email))->queue(new CierreQuejaAceptadaEmail($quejasClientes));
                    }
                }
            }
        }

        if (! $email_realizara_accion_inmediata) {
            if (! is_null($quejasClientes->acciones_tomara_responsable)) {
                if ($quejasClientes->registro != null && $quejasClientes->responsableAtencion != null) {
                    $quejasClientes->update([
                        'email_realizara_accion_inmediata' => true,
                    ]);
                    Mail::to(removeUnicodeCharacters($quejasClientes->registro->email))->cc(removeUnicodeCharacters($quejasClientes->responsableAtencion->email))->queue(new AtencionQuejaAtendidaEmail($quejasClientes));
                }
            }
        }

        if ($notificar_registro_queja) {
            if (! $quejasClientes->correo_enviado_registro) {
                if ($quejasClientes->registro != null && $quejasClientes->responsableAtencion != null) {
                    $quejasClientes->update([
                        'correo_enviado_registro' => true,
                    ]);
                    Mail::to(removeUnicodeCharacters($quejasClientes->registro->email))->cc(removeUnicodeCharacters($quejasClientes->responsableAtencion->email))->queue(new NotificacionResponsableQuejaEmail($quejasClientes, $quejasClientes->responsableAtencion));
                }
            }
        }

        if ($desea_levantar_ac) {
            $quejasClientes->load('cliente', 'proyectos', 'responsableAtencion', 'responsableSgi', 'registro');
            $evidenciaArr = [];
            $evidencias = EvidenciaQuejasClientes::where('quejas_clientes_id', '=', $quejasClientes->id)->get();
            foreach ($evidencias as $evidencia) {
                array_push($evidenciaArr, $evidencia->evidencia);
            }
            $existeAC = AccionCorrectiva::whereHas('deskQuejaCliente', function ($query) use ($quejasClientes) {
                $query->where('acciones_correctivas_aprobacionables_id', $quejasClientes->id);
            })->exists();

            if (! $existeAC) {
                $accion_correctiva = AccionCorrectiva::create([
                    'tema' => $request->titulo,
                    'causaorigen' => 'Queja de un cliente',
                    'descripcion' => $request->descripcion,
                    'estatus' => 'nuevo',
                    'fecharegistro' => Carbon::now(),
                    'areas' => $request->area_quejado,
                    'procesos' => $request->proceso_quejado,
                    'es_externo' => true,
                    'otro_categoria' => $request->otro_categoria,
                    'id_registro' => $request->responsable_sgi_id,
                    'estatus' => 'Sin atender',
                    'aprobada' => false,
                    'aprobacion_contestada' => false,
                    'id_reporto' => $request->empleado_reporto_id,
                    'otros' => $request->otro_quejado,
                    'colaborador_quejado' => $request->colaborador_quejado,

                ]);
                $quejasClientes->update([
                    'accion_correctiva_id' => $accion_correctiva->id,

                ]);
                $quejasClientes->accionCorrectivaAprobacional()->sync($accion_correctiva->id);
            }

            if (! $quejasClientes->correoEnviado) {
                $quejasClientes->update([
                    'correoEnviado' => true,
                ]);
                Mail::to(removeUnicodeCharacters($quejasClientes->responsableSgi->email))->cc(removeUnicodeCharacters($quejasClientes->registro->email))->queue(new AceptacionAccionCorrectivaEmail($quejasClientes, $evidenciaArr));
            }
        }
        if ($request->ajax()) {
            return response()->json(['estatus' => 200]);
        }

        // return redirect()->route('admin.desk.quejas-edit', $id_quejas)->with('success', 'Reporte actualizado');
        return redirect()->route('admin.desk.index')->with('success', 'Reporte actualizado');
    }

    public function correoResponsableQuejaCliente(Request $request)
    {
        $id_quejas = $request->id;
        $quejasClientes = QuejasCliente::find(intval($id_quejas))->load('evidencias_quejas', 'planes', 'cierre_evidencias', 'cliente', 'proyectos', 'responsableAtencion');

        $quejasClientes->update([
            'responsable_atencion_queja_id' => $request->responsable_atencion_queja_id,
        ]);

        $empleado_email = Empleado::select('name', 'email')->find($request->responsable_atencion_queja_id);
        $empleado_copia = User::getCurrentUser()->empleado;

        if ($quejasClientes->registro != null && $request->responsable_atencion_queja_id != null) {
            Mail::to(removeUnicodeCharacters($empleado_email->email))->cc(removeUnicodeCharacters($empleado_copia->email))->queue(new NotificacionResponsableQuejaEmail($quejasClientes, $empleado_email));
        }

        return response()->json(['success' => true, 'request' => $request->all(), 'message' => 'Enviado con éxito']);
    }

    public function correoSolicitarCierreQuejaCliente(Request $request)
    {
        $id_quejas = $request->id;
        $quejasClientes = QuejasCliente::find(intval($id_quejas))->load('evidencias_quejas', 'planes', 'cierre_evidencias', 'cliente', 'proyectos', 'responsableAtencion');

        Mail::to(removeUnicodeCharacters($quejasClientes->registro->email))->cc(removeUnicodeCharacters($quejasClientes->responsableAtencion->email))->queue(new SolicitarCierreQuejaEmail($quejasClientes));

        return response()->json(['success' => true, 'request' => $request->all(), 'message' => 'Enviado con éxito']);
    }

    public function updateAnalisisQuejasClientes(Request $request, $id_quejas)
    {
        $analisis_quejasClientes = AnalisisQuejasClientes::findOrfail(intval($id_quejas));
        $analisis_quejasClientes->update([
            'problema_diagrama' => $request->problema_diagrama,
            'problema_porque' => $request->problema_porque,
            'causa_ideas' => $request->causa_ideas,
            'causa_porque' => $request->causa_porque,
            'ideas' => $request->ideas,
            'porque_1' => $request->porque_1,
            'porque_2' => $request->porque_2,
            'porque_3' => $request->porque_3,
            'porque_4' => $request->porque_4,
            'porque_5' => $request->porque_5,
            'control_a' => $request->control_a,
            'control_b' => $request->control_b,
            'proceso_a' => $request->proceso_a,
            'proceso_b' => $request->proceso_b,
            'personas_a' => $request->personas_a,
            'personas_b' => $request->personas_b,
            'tecnologia_a' => $request->tecnologia_a,
            'tecnologia_b' => $request->tecnologia_b,
            'metodos_a' => $request->metodos_a,
            'metodos_b' => $request->metodos_b,
            'ambiente_a' => $request->ambiente_a,
            'ambiente_b' => $request->ambiente_b,
            'fecha_cierre' => $request->fecha_cierre,
        ]);

        return redirect()->route('admin.desk.index', $analisis_quejasClientes->quejas_id)->with('success', 'Reporte actualizado');
    }

    public function planesQuejasClientes(Request $request)
    {
        $quejasClientes = QuejasCliente::find($request->id);
        // $quejasClientes->planes()->detach();
        $quejasClientes->planes()->sync($request->planes);

        return response()->json(['success' => true]);
    }

    public function archivoQuejaClientes()
    {
        $quejas = QuejasCliente::getAll()->where('archivado', true);

        return view('admin.desk.clientes.archivo', compact('quejas'));
    }

    public function archivadoQuejaClientes(Request $request, $id)
    {

        if ($request->ajax()) {
            $queja = QuejasCliente::findOrfail(intval($id));
            $queja->update([
                'archivado' => true,
            ]);

            return response()->json(['success' => true]);
        }
    }

    public function recuperarArchivadoQuejaCliente($id)
    {
        $queja = QuejasCliente::find($id);

        $queja->update([
            'archivado' => false,
        ]);

        return redirect()->route('admin.desk.index');
    }

    public function quejasClientesDashboard()
    {
        abort_if(Gate::denies('centro_atencion_quejas_cliente_dashboard'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $quejasClientes = QuejasCliente::getAll();

        $quejasClientesSaA = $quejasClientes->where('estatus', 'Sin atender')->where('prioridad', 'Alta')->count();
        $quejasClientesSaM = $quejasClientes->where('estatus', 'Sin atender')->where('prioridad', 'Media')->count();
        $quejasClientesSaB = $quejasClientes->where('estatus', 'Sin atender')->where('prioridad', 'Baja')->count();
        $quejasClientesSaSd = $quejasClientes->where('estatus', 'Sin atender')->where('prioridad', null)->count();

        $quejasClientesEcA = $quejasClientes->where('estatus', 'En curso')->where('prioridad', 'Alta')->count();
        $quejasClientesEcM = $quejasClientes->where('estatus', 'En curso')->where('prioridad', 'Media')->count();
        $quejasClientesEcB = $quejasClientes->where('estatus', 'En curso')->where('prioridad', 'Baja')->count();
        $quejasClientesEcSd = $quejasClientes->where('estatus', 'En curso')->where('prioridad', null)->count();

        $quejasClientesEeA = $quejasClientes->where('estatus', 'En espera')->where('prioridad', 'Alta')->count();
        $quejasClientesEeM = $quejasClientes->where('estatus', 'En espera')->where('prioridad', 'Media')->count();
        $quejasClientesEeB = $quejasClientes->where('estatus', 'En espera')->where('prioridad', 'Baja')->count();
        $quejasClientesEeSd = $quejasClientes->where('estatus', 'En espera')->where('prioridad', null)->count();

        $quejasClientesCA = $quejasClientes->where('estatus', 'Cerrado')->where('prioridad', 'Alta')->count();
        $quejasClientesCM = $quejasClientes->where('estatus', 'Cerrado')->where('prioridad', 'Media')->count();
        $quejasClientesCB = $quejasClientes->where('estatus', 'Cerrado')->where('prioridad', 'Baja')->count();
        $quejasClientesCSd = $quejasClientes->where('estatus', 'Cerrado')->where('prioridad', null)->count();

        $quejasClientesCanA = $quejasClientes->where('estatus', 'No procedente')->where('prioridad', 'Alta')->count();
        $quejasClientesCanM = $quejasClientes->where('estatus', 'No procedente')->where('prioridad', 'Media')->count();
        $quejasClientesCanB = $quejasClientes->where('estatus', 'No procedente')->where('prioridad', 'Baja')->count();
        $quejasClientesCanSd = $quejasClientes->where('estatus', 'No procedente')->where('prioridad', null)->count();

        $quejaEstatusAltaArray = [$quejasClientesSaA, $quejasClientesEcA, $quejasClientesEeA, $quejasClientesCA, $quejasClientesCanA];
        $quejaEstatusMediaArray = [$quejasClientesSaM, $quejasClientesEcM, $quejasClientesEeM, $quejasClientesCM, $quejasClientesCanM];
        $quejaEstatusBajaArray = [$quejasClientesSaB, $quejasClientesEcB, $quejasClientesEeB, $quejasClientesCB, $quejasClientesCanB];
        $quejaEstatusSinDArray = [$quejasClientesSaSd, $quejasClientesEcSd, $quejasClientesEeSd, $quejasClientesCSd, $quejasClientesCanSd];

        $quejaPrioridadA = $quejasClientes->where('prioridad', 'Alta')->count();
        $quejaPrioridadM = $quejasClientes->where('prioridad', 'Media')->count();
        $quejaPrioridadB = $quejasClientes->where('prioridad', 'Baja')->count();

        $quejaAcSolicitada = $quejasClientes->where('desea_levantar_ac', true)->count();
        $quejaAcNoSolicitada = $quejasClientes->where('desea_levantar_ac', false)->count();

        $quejaCanalCorreoE = $quejasClientes->where('canal', 'Correo electronico')->count();
        $quejaCanalTelefono = $quejasClientes->where('canal', 'Via telefonica')->count();
        $quejaCanalPresencial = $quejasClientes->where('canal', 'Presencial')->count();
        $quejaCanalRemota = $quejasClientes->where('canal', 'Remota')->count();
        $quejaCanalOficio = $quejasClientes->where('canal', 'Oficio')->count();
        $quejaCanalOtro = $quejasClientes->where('canal', 'Otro')->count();

        $quejaCategoriaServNoP = $quejasClientes->where('categoria_queja', 'Servicio no prestado')->count();
        $quejaCategoriaRetrasoP = $quejasClientes->where('categoria_queja', 'Retraso en la prestacion')->count();
        $quejaCategoriaEntreNoC = $quejasClientes->where('categoria_queja', 'Entregable no conforme')->count();
        $quejaCategoriaIncuComC = $quejasClientes->where('categoria_queja', 'Incumplimiento de los compromisos contractuales')->count();
        $quejasCategoriaIncuNivServ = $quejasClientes->where('categoria_queja', 'Incumplimiento de los niveles de servicio')->count();
        $quejasCategoriaNegPresServ = $quejasClientes->where('categoria_queja', 'Negativa de prestación del servicio')->count();
        $quejasCategoriaIncFact = $quejasClientes->where('categoria_queja', 'Incorrecta facturacion')->count();
        $quejasCategoriaOtro = $quejasClientes->where('categoria_queja', 'Otro')->count();

        $quejaCumplioFecha = $quejasClientes->where('cumplio_fecha', true)->count();
        $quejaNoCumplioFecha = $quejasClientes->where('cumplio_fecha', false)->count();

        $areasCollect = [];
        $areas = [];
        $ticketPorArea = $quejasClientes;
        foreach ($ticketPorArea as $ticketArea) {
            $areas = $ticketArea->area_quejado;
            $areasExplode = explode(',', $areas);
            foreach ($areasExplode as $areaExplode) {
                //$areasCollect->push(trim($areaExplode));
                if (array_key_exists($areaExplode, $areasCollect)) {
                    $areasCollect[trim($areaExplode)] = $areasCollect[trim($areaExplode)] + 1;
                } else {
                    $areasCollect[trim($areaExplode)] = 1;
                }
            }
        }
        $areasCollect = array_filter($areasCollect, function ($item) {
            return $item != '';
        }, ARRAY_FILTER_USE_KEY);

        $procesosCollect = [];
        $ticketPorProceso = $quejasClientes;

        foreach ($ticketPorProceso as $ticketProceso) {
            $procesos = $ticketProceso->proceso_quejado;
            if ($procesos != null) {
                $procesosExplode = explode(',', $procesos);
                foreach ($procesosExplode as $procesoExplode) {
                    if (array_key_exists($procesoExplode, $procesosCollect)) {
                        $procesosCollect[trim($procesoExplode)] = $procesosCollect[trim($procesoExplode)] + 1;
                    } else {
                        $procesosCollect[trim($procesoExplode)] = 1;
                    }
                }
            }
        }
        $procesosCollect = array_filter($procesosCollect, function ($item) {
            return $item != '';
        }, ARRAY_FILTER_USE_KEY);

        $quejasproyectos = array_unique(QuejasCliente::pluck('proyectos_id')->toArray());
        $proyectos = TimesheetProyecto::getAllWithCliente()->find($quejasproyectos);
        $proyectosLabel = [];
        foreach ($proyectos as $proyecto) {

            $cantidad = $quejasClientes->where('proyectos_id', $proyecto->id)->count();
            array_push($proyectosLabel, [
                'nombre' => $proyecto->proyecto,
                'cliente' => $proyecto->cliente->nombre,
                'cantidad' => $cantidad,
            ]);
        }

        $quejasclientes = array_unique(QuejasCliente::pluck('cliente_id')->toArray());
        $clientes = TimesheetCliente::select('nombre', 'id')->find($quejasclientes);
        $clientesLabel = [];
        foreach ($clientes as $cliente) {
            $cantidadClientes = $quejasClientes->where('cliente_id', $cliente->id)->count();
            array_push($clientesLabel, [
                'nombre' => $cliente->nombre,
                'cantidad' => $cantidadClientes,
            ]);
        }

        $total_quejasClientes = $quejasClientes->count();
        $nuevos_quejasClientes = $quejasClientes->where('estatus', 'Sin atender')->count();
        $en_curso_quejasClientes = $quejasClientes->where('estatus', 'En curso')->count();
        $en_espera_quejasClientes = $quejasClientes->where('estatus', 'En espera')->count();
        $cerrados_quejasClientes = $quejasClientes->where('estatus', 'Cerrado')->count();
        $cancelados_quejasClientes = $quejasClientes->where('estatus', 'No procedente')->count();

        return view('admin.desk.clientes.dashboard', compact(
            'ticketPorArea',
            'areas',
            'areasCollect',
            'ticketPorProceso',
            'procesosCollect',
            'total_quejasClientes',
            'nuevos_quejasClientes',
            'en_curso_quejasClientes',
            'en_espera_quejasClientes',
            'cerrados_quejasClientes',
            'cancelados_quejasClientes',
            'quejasclientes',
            'clientes',
            'clientesLabel',
            'proyectosLabel',
            'quejasproyectos',
            'proyectos',
            'quejaCumplioFecha',
            'quejaNoCumplioFecha',
            'quejaCategoriaServNoP',
            'quejaCategoriaRetrasoP',
            'quejaCategoriaEntreNoC',
            'quejaCategoriaIncuComC',
            'quejasCategoriaIncuNivServ',
            'quejasCategoriaNegPresServ',
            'quejasCategoriaIncFact',
            'quejasCategoriaOtro',
            'quejaCanalCorreoE',
            'quejaCanalTelefono',
            'quejaCanalPresencial',
            'quejaCanalRemota',
            'quejaCanalOficio',
            'quejaCanalOtro',
            'quejaAcSolicitada',
            'quejaAcNoSolicitada',
            'quejaPrioridadA',
            'quejaPrioridadM',
            'quejaPrioridadB',
            'quejaEstatusAltaArray',
            'quejaEstatusMediaArray',
            'quejaEstatusBajaArray',
            'quejaEstatusSinDArray'
        ));
    }

    public function validateFormQuejaCliente(Request $request)
    {
        $id_quejas = $request->quejas_clientes_id;

        $quejasClientes = QuejasCliente::with('registro', 'responsableAtencion', 'cliente', 'proyectos')->find(intval($id_quejas));
        if ($request->tipo_validacion == 'queja-registro') {
            $this->validateRequestRegistroQuejaCliente($request);

            return response()->json(['isValid' => true]);
        } elseif ($request->tipo_validacion == 'queja-analisis') {
            $this->validateRequestRegistroQuejaCliente($request);
            $this->validateRequestAnalisisQuejaCliente($request);

            return response()->json(['isValid' => true]);
        } elseif ($request->tipo_validacion == 'queja-atencion') {
            if (! is_null($quejasClientes->responsable_atencion_queja_id)) {
                if ($quejasClientes->responsable_atencion_queja_id != User::getCurrentUser()->empleado->id) {
                    $this->validateRequestRegistroQuejaCliente($request);
                    $this->validateRequestAnalisisQuejaCliente($request);
                }
                $this->validateRequestAtencionQuejaCliente($request);
            } else {
                $this->validateRequestRegistroQuejaCliente($request);
                $this->validateRequestAnalisisQuejaCliente($request);
                $this->validateRequestAtencionQuejaCliente($request);
            }

            return response()->json(['isValid' => true]);
        } elseif ($request->tipo_validacion == 'queja-cierre') {
            $this->validateRequestRegistroQuejaCliente($request);
            $this->validateRequestAnalisisQuejaCliente($request);
            $this->validateRequestAtencionQuejaCliente($request);
            $this->validateRequestCierreQuejaCliente($request);

            return response()->json(['isValid' => true]);
        }
    }

    public function destroyQuejasClientes(Request $request, $quejasClientes)
    {
        $quejasClientes = QuejasCliente::find($quejasClientes);
        $quejasClientes->delete();

        return response()->json(['status' => 'success', 'message' => 'Dato Eliminado']);
    }

    public function validateRequestRegistroQuejaCliente($request)
    {

        $request->validate(
            [
                'cliente_id' => 'required',
                'proyectos_id' => 'required',
                'nombre' => 'required',
                'titulo' => 'required',
                'fecha' => 'required',
                'descripcion' => 'required',
                'area_quejado' => 'required',
                'canal' => 'required',
            ],
            [
                'cliente_id' => 'El campo cliente es obligatorio',
                'proyectos_id' => 'El campo proyecto es obligatorio',
                'titulo' => 'El campo título es obligatorio',
                'fecha' => 'El campo fecha es obligatorio',
                'descripcion' => 'El campo descripción es obligatorio',
                'area_quejado' => 'El campo area es obligatorio',
                'canal' => 'El campo canal es obligatorio',
            ]
        );
    }

    public function validateRequestAnalisisQuejaCliente($request)
    {
        $levantamiento_ac = intval($request->levantamiento_ac) == 1 ? true : false;
        $queja_procedente = intval($request->queja_procedente) == 1 ? true : false;
        if ($queja_procedente) {
            $request->validate(
                [
                    'urgencia' => 'required',
                    'impacto' => 'required',
                    'categoria_queja' => 'required',
                    'responsable_atencion_queja_id' => 'required',

                ],
                [
                    'urgencia' => 'El campo urgencia es obligatorio',
                    'impacto' => 'El campo impacto es obligatorio',
                    'categoria_queja' => 'El campo categoria es obligatorio',
                    'responsable_atencion_queja_id' => 'El campo responsable de la atención es obligatorio',
                ]
            );
            // dd($request->all());
            if ($levantamiento_ac) {
                $request->validate(
                    [
                        'responsable_sgi_id' => 'required',
                    ],
                    [
                        'responsable_sgi_id' => 'El campo responsable del SGI es obligatorio',
                    ]
                );
            }
        }
    }

    public function validateRequestAtencionQuejaCliente($request)
    {
        $request->validate(
            [
                'realizar_accion' => 'required',
                'acciones_tomara_responsable' => 'required',

            ],
            [
                'realizar_accion' => 'El campo realiazar acción es obligatorio',
                'acciones_tomara_responsable' => 'El campo acciones es obligatorio',
            ]
        );
    }

    public function validateRequestCierreQuejaCliente($request)
    {
        $request->validate(
            [
                'porque_no_cumplio_responsable' => 'required',
                'porque_no_cierre_ticket' => 'required',

            ],
            [
                'porque_no_cumplio_responsable' => 'El campo por qué no se cumplieron las acciones es obligatorio',
                'porque_no_cierre_ticket' => 'El campo por qué no se cierra el ticket es obligatorio',
            ]
        );
    }

    public function showQuejaClientes(Request $request)
    {
        $id_quejas = $request->quejas_clientes_id;

        $quejasClientes = QuejasCliente::findOrfail(intval($id_quejas))->load('evidencias_quejas', 'planes', 'cierre_evidencias', 'cliente', 'proyectos');

        return view('admin.desk.quejas-clientes.show', compact('quejasClientes', 'id_quejas'));
    }
}
