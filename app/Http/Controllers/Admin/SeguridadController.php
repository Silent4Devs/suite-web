<?php

namespace App\Http\Controllers\Admin;

use App\Events\IncidentesDeSeguridadEvent;
use App\Http\Controllers\Controller;
use App\Mail\SolicitudAprobacion;
use App\Models\Activo;
use App\Models\AnalisisSeguridad;
use App\Models\AprobadorSeleccionado;
use App\Models\Area;
use App\Models\CategoriaIncidente;
use App\Models\Empleado;
use App\Models\EvidenciasSeguridad;
use App\Models\FirmaCentroAtencion;
use App\Models\FirmaModule;
use App\Models\IncidentesSeguridad;
use App\Models\Organizacion;
use App\Models\Proceso;
use App\Models\Sede;
use App\Models\SubcategoriaIncidente;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class SeguridadController extends Controller
{
    public function seguridad()
    {
        abort_if(Gate::denies('mi_perfil_mis_reportes_realizar_reporte_de_sugerencia'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $areas = Area::getIdNameAll();

        $procesos = Proceso::getAll();

        $activos = Activo::getAll();

        $empleados = Empleado::getIDaltaAll();

        $sedes = Sede::getAll();

        $subcategorias = SubcategoriaIncidente::get();

        $incidentes_seguridad = IncidentesSeguridad::getAll();

        return view('admin.inicioUsuario.formularios.seguridad', compact('incidentes_seguridad', 'activos', 'areas', 'procesos', 'sedes', 'subcategorias'));
    }

    public function storeSeguridad(Request $request)
    {
        // $incidente_procedente = intval($request->procedente ? $request->procedente : $incidentes_seguridad->procedente) == 1 ? true : false;
        $incidente_procedente = intval($request->procedente) == 1 ? true : false;

        $request->validate([
            'titulo' => 'required|string',
            'fecha' => 'required',
            'sede' => 'required',
            'ubicacion' => 'nullable|string',
            'descripcion' => 'required',
            'procedente' => 'required',
        ]);

        $incidentes_seguridad = IncidentesSeguridad::create([
            'titulo' => $request->titulo,
            'fecha' => $request->fecha,
            'sede' => $request->sede,
            'ubicacion' => $request->ubicacion,
            'descripcion' => $request->descripcion,
            'areas_afectados' => $request->areas_afectados,
            'procesos_afectados' => $request->procesos_afectados,
            'activos_afectados' => $request->activos_afectados,
            'empleado_reporto_id' => User::getCurrentUser()->empleado->id,
            'procedente' => $incidente_procedente,
            'justificacion' => $request->justificacion,
        ]);

        if ($incidente_procedente) {
            $incidentes_seguridad->update([
                'estatus' => 'Sin atender',

            ]);
        } else {
            $incidentes_seguridad->update([
                'estatus' => 'No procedente',
            ]);
        }

        AnalisisSeguridad::create([
            'seguridad_id' => $incidentes_seguridad->id,
            'formulario' => 'seguridad',
        ]);

        $image = null;

        if ($request->file('evidencia') != null or ! empty($request->file('evidencia'))) {
            foreach ($request->file('evidencia') as $file) {
                $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);

                $name_image = basename(pathinfo($file->getClientOriginalName(), PATHINFO_BASENAME), '.'.$extension);

                $new_name_image = 'Seguridad_file_'.$incidentes_seguridad->id.'_'.$name_image.'.'.$extension;

                $route = 'public/evidencias_seguridad';

                $image = $new_name_image;

                $file->storeAs($route, $image);

                EvidenciasSeguridad::create([
                    'evidencia' => $image,
                    'id_seguridad' => $incidentes_seguridad->id,
                ]);
            }
        }

        return redirect()->route('admin.desk.index')->with('success', 'Reporte generado');
    }

    public function indexSeguridad()
    {
        abort_if(Gate::denies('centro_atencion_incidentes_de_seguridad_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $incidentes_seguridad = IncidentesSeguridad::getAll();

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

        $empleados = Empleado::getIDaltaAll();

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

        $aprobadorSeleccionado = new AprobadorSeleccionado;

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

        $fecha_cierre = ($request->estatus === 'No procedente' || $request->estatus === 'Cerrado')
        ? Carbon::now()->format('Y-m-d H:i:s')
        : ($request->fecha_cierre ? Carbon::createFromFormat('d-m-Y H:i:s', $request->fecha_cierre, 'UTC')->format('Y-m-d H:i:s') : null);

        $incidentesSeguridad->update([
            'titulo' => $request->titulo,
            'estatus' => $request->estatus,
            'fecha' => $request->fecha,
            'empleado_asignado_id' => $request->empleado_asignado_id,
            'sede' => $request->sede,
            'ubicacion' => $request->ubicacion,
            'descripcion' => $request->descripcion,
            'fecha_cierre' => $fecha_cierre,
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

            $aprobadorSeleccionado = new AprobadorSeleccionado;

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

            event(new IncidentesDeSeguridadEvent($incidentesSeguridad, 'update', 'incidentes_de_seguridads', 'Incidente de Seguridad'));
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
}
