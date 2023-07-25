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
use App\Models\AccionCorrectiva;
use App\Models\Activo;
use App\Models\AnalisisQuejasClientes;
use App\Models\AnalisisSeguridad;
use App\Models\Area;
use App\Models\CategoriaIncidente;
use App\Models\Denuncias;
use App\Models\Empleado;
use App\Models\EvidenciaQuejasClientes;
use App\Models\EvidenciasQuejasClientesCerrado;
use App\Models\EvidenciasSeguridad;
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
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail; //mejora apunta a este modelo
use App\Traits\ObtenerOrganizacion;

class DeskController extends Controller
{
    use ObtenerOrganizacion;

    public function index()
    {
        abort_if(Gate::denies('centro_de_atencion_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $incidentes_seguridad = IncidentesSeguridad::where('archivado', IncidentesSeguridad::NO_ARCHIVADO)->orderBy('id')->get();
        $riesgos_identificados = RiesgoIdentificado::orderBy('id')->get();
        $quejas = Quejas::orderBy('id')->get();
        $denuncias = Denuncias::orderBy('id')->get();
        $mejoras = Mejoras::orderBy('id')->get();
        $sugerencias = Sugerencias::orderBy('id')->get();

        $total_seguridad = IncidentesSeguridad::get()->count();
        $nuevos_seguridad = IncidentesSeguridad::where('estatus', 'Sin atender')->get()->count();
        $en_curso_seguridad = IncidentesSeguridad::where('estatus', 'En curso')->get()->count();
        $en_espera_seguridad = IncidentesSeguridad::where('estatus', 'En espera')->get()->count();
        $cerrados_seguridad = IncidentesSeguridad::where('estatus', 'Cerrado')->get()->count();
        $cancelados_seguridad = IncidentesSeguridad::where('estatus', 'No procedente')->get()->count();

        $total_riesgos = RiesgoIdentificado::get()->count();
        $nuevos_riesgos = RiesgoIdentificado::where('estatus', 'nuevo')->get()->count();
        $en_curso_riesgos = RiesgoIdentificado::where('estatus', 'en curso')->get()->count();
        $en_espera_riesgos = RiesgoIdentificado::where('estatus', 'en espera')->get()->count();
        $cerrados_riesgos = RiesgoIdentificado::where('estatus', 'cerrado')->get()->count();
        $cancelados_riesgos = RiesgoIdentificado::where('estatus', 'cancelado')->get()->count();

        $total_quejas = Quejas::get()->count();
        $nuevos_quejas = Quejas::where('estatus', 'nuevo')->get()->count();
        $en_curso_quejas = Quejas::where('estatus', 'en curso')->get()->count();
        $en_espera_quejas = Quejas::where('estatus', 'en espera')->get()->count();
        $cerrados_quejas = Quejas::where('estatus', 'cerrado')->get()->count();
        $cancelados_quejas = Quejas::where('estatus', 'cancelado')->get()->count();

        $total_quejasClientes = QuejasCliente::get()->count();
        $nuevos_quejasClientes = QuejasCliente::where('estatus', 'Sin atender')->get()->count();
        $en_curso_quejasClientes = QuejasCliente::where('estatus', 'En curso')->get()->count();
        $en_espera_quejasClientes = QuejasCliente::where('estatus', 'En espera')->get()->count();
        $cerrados_quejasClientes = QuejasCliente::where('estatus', 'Cerrado')->get()->count();
        $cancelados_quejasClientes = QuejasCliente::where('estatus', 'No procedente')->get()->count();

        $total_denuncias = Denuncias::get()->count();
        $nuevos_denuncias = Denuncias::where('estatus', 'nuevo')->get()->count();
        $en_curso_denuncias = Denuncias::where('estatus', 'en curso')->get()->count();
        $en_espera_denuncias = Denuncias::where('estatus', 'en espera')->get()->count();
        $cerrados_denuncias = Denuncias::where('estatus', 'cerrado')->get()->count();
        $cancelados_denuncias = Denuncias::where('estatus', 'cancelado')->get()->count();

        $total_mejoras = Mejoras::get()->count();
        $nuevos_mejoras = Mejoras::where('estatus', 'nuevo')->get()->count();
        $en_curso_mejoras = Mejoras::where('estatus', 'en curso')->get()->count();
        $en_espera_mejoras = Mejoras::where('estatus', 'en espera')->get()->count();
        $cerrados_mejoras = Mejoras::where('estatus', 'cerrado')->get()->count();
        $cancelados_mejoras = Mejoras::where('estatus', 'cancelado')->get()->count();

        $total_sugerencias = Sugerencias::get()->count();
        $nuevos_sugerencias = Sugerencias::where('estatus', 'nuevo')->get()->count();
        $en_curso_sugerencias = Sugerencias::where('estatus', 'en curso')->get()->count();
        $en_espera_sugerencias = Sugerencias::where('estatus', 'en espera')->get()->count();
        $cerrados_sugerencias = Sugerencias::where('estatus', 'cerrado')->get()->count();
        $cancelados_sugerencias = Sugerencias::where('estatus', 'cancelado')->get()->count();

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

        $incidentes_seguridad = IncidentesSeguridad::with('asignado', 'reporto')->where('archivado', IncidentesSeguridad::NO_ARCHIVADO)->get();

        return datatables()->of($incidentes_seguridad)->toJson();
    }

    public function editSeguridad(Request $request, $id_incidente)
    {
        abort_if(Gate::denies('centro_atencion_incidentes_de_seguridad_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $incidentesSeguridad = IncidentesSeguridad::findOrfail(intval($id_incidente))->load('evidencias_seguridad');

        // $incidentesSeguridad = IncidentesSeguridad::findOrfail(intval($id_incidente));

        $analisis = AnalisisSeguridad::where('formulario', '=', 'seguridad')->where('seguridad_id', intval($id_incidente))->first();

        $activos = Activo::getAll();

        $empleados = Empleado::getaltaAll();

        $sedes = Sede::getAll();

        $areas = Area::getAll();

        $procesos = Proceso::getAll();

        $subcategorias = SubcategoriaIncidente::get();

        $categorias = CategoriaIncidente::get();

        return view('admin.desk.seguridad.edit', compact('incidentesSeguridad', 'activos', 'empleados', 'sedes', 'areas', 'procesos', 'subcategorias', 'categorias', 'analisis'));
    }

    public function updateSeguridad(Request $request, $id_incidente)
    {
        abort_if(Gate::denies('centro_atencion_incidentes_de_seguridad_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        //    dd($request->all());
        $incidentesSeguridad = IncidentesSeguridad::findOrfail(intval($id_incidente));
        // dd( $incidentesSeguridad);

        $request->validate([
            'titulo' => 'required|string',
            'fecha' => 'required',
            'sede' => 'required',
            'ubicacion' => 'nullable|string',
            'descripcion' => 'required',
            'estatus' => 'required',
        ]);

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
        // dd($incidentesSeguridad);
        $documento = $incidentesSeguridad->evidencia;
        // dd($documento);
        if ($request->file('evidencia') != null or !empty($request->file('evidencia'))) {
            foreach ($request->file('evidencia') as $file) {
                $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);

                $name_documento = basename(pathinfo($file->getClientOriginalName(), PATHINFO_BASENAME), '.' . $extension);

                $new_name_documento = 'Seguridad_file_' . $incidentesSeguridad->id . '_' . $name_documento . '.' . $extension;

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
        $incidentes_seguridad_archivados = IncidentesSeguridad::where('archivado', IncidentesSeguridad::ARCHIVADO)->get();

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
        // dd($recurso);
        $riesgo->update([
            'archivado' => false,
        ]);

        return redirect()->route('admin.desk.index');
    }

    public function editRiesgos(Request $request, $id_riesgos)
    {
        abort_if(Gate::denies('centro_atencion_riesgos_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $riesgos = RiesgoIdentificado::findOrfail(intval($id_riesgos))->load('evidencias_riesgos');

        $analisis = AnalisisSeguridad::where('formulario', '=', 'riesgo')->where('riesgos_id', intval($id_riesgos))->first();
        if (is_null($analisis)) {
            $analisis = collect();
        }
        $procesos = Proceso::getAll();

        $activos = Activo::getAll();

        $areas = Area::getAll();

        $sedes = Sede::getAll();

        $empleados = Empleado::getaltaAll();

        return view('admin.desk.riesgos.edit', compact('riesgos', 'procesos', 'empleados', 'areas', 'activos', 'sedes', 'analisis'));
    }

    public function updateRiesgos(Request $request, $id_riesgos)
    {
        abort_if(Gate::denies('centro_atencion_riesgos_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $riesgos = RiesgoIdentificado::findOrfail(intval($id_riesgos));
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
        $riesgos = RiesgoIdentificado::where('archivado', true)->get();

        return view('admin.desk.riesgos.archivo', compact('riesgos'));
    }

    public function recuperarArchivadoRiesgo($id)
    {
        $riesgo = RiesgoIdentificado::find($id);
        // dd($recurso);
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

        $quejas = Quejas::findOrfail(intval($id_quejas))->load('evidencias_quejas');

        $procesos = Proceso::getAll();

        $activos = Activo::getAll();

        $analisis = AnalisisSeguridad::where('formulario', '=', 'queja')->where('quejas_id', intval($id_quejas))->first();

        $areas = Area::getAll();

        $sedes = Sede::getAll();

        $empleados = Empleado::getaltaAll();

        return view('admin.desk.quejas.edit', compact('quejas', 'procesos', 'empleados', 'areas', 'activos', 'sedes', 'analisis'));
    }

    public function updateQuejas(Request $request, $id_quejas)
    {
        abort_if(Gate::denies('centro_atencion_quejas_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $quejas = Quejas::findOrfail(intval($id_quejas));
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
        // dd($request);
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
        $quejas = Quejas::where('archivado', true)->get();

        return view('admin.desk.quejas.archivo', compact('quejas'));
    }

    public function recuperarArchivadoQueja($id)
    {
        $queja = Quejas::find($id);
        // dd($recurso);
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

        $analisis = AnalisisSeguridad::where('formulario', '=', 'denuncia')->where('denuncias_id', intval($id_denuncias))->first();

        $denuncias = Denuncias::findOrfail(intval($id_denuncias));

        $activos = Activo::getAll();

        $empleados = Empleado::getaltaAll();

        return view('admin.desk.denuncias.edit', compact('denuncias', 'activos', 'empleados', 'analisis'));
    }

    public function updateDenuncias(Request $request, $id_denuncias)
    {
        abort_if(Gate::denies('centro_atencion_denuncias_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $denuncias = Denuncias::findOrfail(intval($id_denuncias));
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
        // dd($recurso);
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

        $mejoras = Mejoras::findOrfail(intval($id_mejoras));

        $activos = Activo::getAll();

        $empleados = Empleado::getaltaAll();

        $areas = Area::getAll();

        $procesos = Proceso::getAll();

        $analisis = AnalisisSeguridad::where('formulario', '=', 'mejora')->where('mejoras_id', intval($id_mejoras))->first();

        return view('admin.desk.mejoras.edit', compact('mejoras', 'activos', 'empleados', 'areas', 'procesos', 'analisis'));
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

        $mejoras = Mejoras::findOrfail(intval($id_mejoras));
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

        // return redirect()->route('admin.desk.mejoras-edit', $id_mejoras)->with('success', 'Reporte actualizado');
        return redirect()->route('admin.desk.index')->with('success', 'Reporte actualizado');
    }

    public function updateAnalisisMejoras(Request $request, $id_mejoras)
    {
        // dd($request->all());
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
        // dd($recurso);
        $mejora->update([
            'archivado' => false,
        ]);

        return redirect()->route('admin.desk.index');
    }

    public function editSugerencias(Request $request, $id_sugerencias)
    {
        abort_if(Gate::denies('centro_atencion_sugerencias_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sugerencias = Sugerencias::findOrfail(intval($id_sugerencias));

        $activos = Activo::getAll();

        $empleados = Empleado::getaltaAll();

        $areas = Area::getAll();

        $procesos = Proceso::getAll();

        $analisis = AnalisisSeguridad::where('formulario', '=', 'sugerencia')->where('sugerencias_id', intval($id_sugerencias))->first();

        return view('admin.desk.sugerencias.edit', compact('sugerencias', 'activos', 'empleados', 'areas', 'procesos', 'analisis'));
    }

    public function updateSugerencias(Request $request, $id_sugerencias)
    {
        abort_if(Gate::denies('centro_atencion_sugerencias_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sugerencias = Sugerencias::findOrfail(intval($id_sugerencias));
        $sugerencias->update([
            'area_sugerencias' => $request->area_sugerencias,
            'proceso_sugerencias' => $request->proceso_sugerencias,

            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,

            'estatus' => $request->estatus,

            'fecha_cierre' => $request->fecha_cierre,
        ]);

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
        // dd($recurso);
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
        // dd($quejasClientes);
        return datatables()->of($quejasClientes)->toJson();
    }

    public function storeQuejasClientes(Request $request)
    {
        abort_if(Gate::denies('centro_atencion_quejas_clientes_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // dd($request->correo);
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
            'empleado_reporto_id' => auth()->user()->empleado->id,
            'correo_cliente' => $correo_cliente,

        ]);

        AnalisisQuejasClientes::create([
            'quejas_clientes_id' => $quejasClientes->id,
            'formulario' => 'quejaCliente',
        ]);

        $image = null;

        if ($request->file('evidencia') != null or !empty($request->file('evidencia'))) {
            foreach ($request->file('evidencia') as $file) {
                $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);

                $name_image = basename(pathinfo($file->getClientOriginalName(), PATHINFO_BASENAME), '.' . $extension);

                $new_name_image = 'Queja_file_' . $quejasClientes->id . '_' . $name_image . '.' . $extension;

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
            Mail::to($quejasClientes->correo)->cc($quejasClientes->registro->email)->send(new SeguimientoQuejaClienteEmail($quejasClientes));
        }

        return redirect()->route('admin.desk.index')->with('success', 'Reporte generado');
    }

    public function editQuejasClientes(Request $request, $id_quejas)
    {
        abort_if(Gate::denies('centro_atencion_quejas_cliente_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $quejasClientes = QuejasCliente::findOrfail(intval($id_quejas))->load('evidencias_quejas', 'planes', 'cierre_evidencias', 'cliente', 'proyectos');
        // dd($quejasClientes);
        $procesos = Proceso::getAll();

        $activos = Activo::getAll();

        $analisis = AnalisisQuejasClientes::where('formulario', '=', 'quejaCliente')->where('quejas_clientes_id', intval($id_quejas))->first();
        // dd($analisis);
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
        // dd($request->all());
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
            'acciones_tomara_responsable' =>  $request->acciones_tomara_responsable ? $request->acciones_tomara_responsable : $quejasClientes->acciones_tomara_responsable,
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
            'porque_no_cierre_ticket' =>  $request->porque_no_cierre_ticket ? $request->porque_no_cierre_ticket : $quejasClientes->porque_no_cierre_ticket,
            'notificar_atencion_queja_no_aprobada' => $notificar_atencion_queja_no_aprobada,
        ]);

        $documento = null;

        if ($request->file('evidencia') != null or !empty($request->file('evidencia'))) {
            foreach ($request->file('evidencia') as $file) {
                $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);

                $name_documento = basename(pathinfo($file->getClientOriginalName(), PATHINFO_BASENAME), '.' . $extension);

                $new_name_documento = 'Queja_file_' . $quejasClientes->id . '_' . $name_documento . '.' . $extension;

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

        if ($request->file('cierre') != null or !empty($request->file('cierre'))) {
            foreach ($request->file('cierre') as $file) {
                $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);

                $name_image = basename(pathinfo($file->getClientOriginalName(), PATHINFO_BASENAME), '.' . $extension);

                $new_name_image = 'Queja_file_' . $quejasClientes->id . '_' . $name_image . '.' . $extension;

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
        // dd($cerrar_ticket);
        if ($cerrar_ticket) {
            $quejasClientes->update([
                'estatus' => 'Cerrado',
                'fecha_cierre' => now(),
            ]);
        }

        if ($notificar_atencion_queja_no_aprobada) {
            if ($cerrar_ticket == false) {
                if (!$quejasClientes->email_env_resolucion_rechazada) {
                    if ($quejasClientes->registro != null && $quejasClientes->responsableAtencion != null) {
                        $quejasClientes->update([
                            'email_env_resolucion_rechazada' => true,
                        ]);
                        Mail::to($quejasClientes->responsableAtencion->email)->cc($quejasClientes->registro->email)->send(new ResolucionQuejaRechazadaEmail($quejasClientes));
                    }
                }
            }
        }

        if ($notificar_atencion_queja_no_aprobada) {
            if ($cerrar_ticket) {
                if (!$quejasClientes->email_env_resolucion_aprobada) {
                    if ($quejasClientes->registro != null && $quejasClientes->responsableAtencion != null) {
                        $quejasClientes->update([
                            'email_env_resolucion_aprobada' => true,
                        ]);
                        Mail::to($quejasClientes->responsableAtencion->email)->cc($quejasClientes->registro->email)->send(new CierreQuejaAceptadaEmail($quejasClientes));
                    }
                }
            }
        }

        if (!$email_realizara_accion_inmediata) {
            if (!is_null($quejasClientes->acciones_tomara_responsable)) {
                if ($quejasClientes->registro != null && $quejasClientes->responsableAtencion != null) {
                    $quejasClientes->update([
                        'email_realizara_accion_inmediata' => true,
                    ]);
                    Mail::to($quejasClientes->registro->email)->cc($quejasClientes->responsableAtencion->email)->send(new AtencionQuejaAtendidaEmail($quejasClientes));
                }
            }
        }

        if ($notificar_registro_queja) {
            if (!$quejasClientes->correo_enviado_registro) {
                if ($quejasClientes->registro != null && $quejasClientes->responsableAtencion != null) {
                    $quejasClientes->update([
                        'correo_enviado_registro' => true,
                    ]);
                    Mail::to($quejasClientes->registro->email)->cc($quejasClientes->responsableAtencion->email)->send(new NotificacionResponsableQuejaEmail($quejasClientes, $quejasClientes->responsableAtencion));
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

            if (!$existeAC) {
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

            if (!$quejasClientes->correoEnviado) {
                $quejasClientes->update([
                    'correoEnviado' => true,
                ]);
                Mail::to($quejasClientes->responsableSgi->email)->cc($quejasClientes->registro->email)->send(new AceptacionAccionCorrectivaEmail($quejasClientes, $evidenciaArr));
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
        $empleado_copia = auth()->user()->empleado;

        if ($quejasClientes->registro != null && $request->responsable_atencion_queja_id != null) {
            Mail::to($empleado_email->email)->cc($empleado_copia->email)->send(new NotificacionResponsableQuejaEmail($quejasClientes, $empleado_email));
        }

        return response()->json(['success' => true, 'request' => $request->all(), 'message' => 'Enviado con éxito']);
    }

    public function correoSolicitarCierreQuejaCliente(Request $request)
    {
        $id_quejas = $request->id;
        $quejasClientes = QuejasCliente::find(intval($id_quejas))->load('evidencias_quejas', 'planes', 'cierre_evidencias', 'cliente', 'proyectos', 'responsableAtencion');

        Mail::to($quejasClientes->registro->email)->cc($quejasClientes->responsableAtencion->email)->send(new SolicitarCierreQuejaEmail($quejasClientes));

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
        $quejas = QuejasCliente::where('archivado', true)->get();

        return view('admin.desk.clientes.archivo', compact('quejas'));
    }

    public function archivadoQuejaClientes(Request $request, $id)
    {
        // dd($request);
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
        // dd($recurso);
        $queja->update([
            'archivado' => false,
        ]);

        return redirect()->route('admin.desk.index');
    }

    public function quejasClientesDashboard()
    {
        abort_if(Gate::denies('centro_atencion_quejas_cliente_dashboard'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $quejasClientesSaA = QuejasCliente::select('id', 'prioridad', 'estatus')->where('estatus', 'Sin atender')->where('prioridad', 'Alta')->count();
        $quejasClientesSaM = QuejasCliente::select('id', 'prioridad', 'estatus')->where('estatus', 'Sin atender')->where('prioridad', 'Media')->count();
        $quejasClientesSaB = QuejasCliente::select('id', 'prioridad', 'estatus')->where('estatus', 'Sin atender')->where('prioridad', 'Baja')->count();
        $quejasClientesSaSd = QuejasCliente::select('id', 'prioridad', 'estatus')->where('estatus', 'Sin atender')->where('prioridad', null)->count();

        $quejasClientesEcA = QuejasCliente::select('id', 'prioridad', 'estatus')->where('estatus', 'En curso')->where('prioridad', 'Alta')->count();
        $quejasClientesEcM = QuejasCliente::select('id', 'prioridad', 'estatus')->where('estatus', 'En curso')->where('prioridad', 'Media')->count();
        $quejasClientesEcB = QuejasCliente::select('id', 'prioridad', 'estatus')->where('estatus', 'En curso')->where('prioridad', 'Baja')->count();
        $quejasClientesEcSd = QuejasCliente::select('id', 'prioridad', 'estatus')->where('estatus', 'En curso')->where('prioridad', null)->count();

        $quejasClientesEeA = QuejasCliente::select('id', 'prioridad', 'estatus')->where('estatus', 'En espera')->where('prioridad', 'Alta')->count();
        $quejasClientesEeM = QuejasCliente::select('id', 'prioridad', 'estatus')->where('estatus', 'En espera')->where('prioridad', 'Media')->count();
        $quejasClientesEeB = QuejasCliente::select('id', 'prioridad', 'estatus')->where('estatus', 'En espera')->where('prioridad', 'Baja')->count();
        $quejasClientesEeSd = QuejasCliente::select('id', 'prioridad', 'estatus')->where('estatus', 'En espera')->where('prioridad', null)->count();

        $quejasClientesCA = QuejasCliente::select('id', 'prioridad', 'estatus')->where('estatus', 'Cerrado')->where('prioridad', 'Alta')->count();
        $quejasClientesCM = QuejasCliente::select('id', 'prioridad', 'estatus')->where('estatus', 'Cerrado')->where('prioridad', 'Media')->count();
        $quejasClientesCB = QuejasCliente::select('id', 'prioridad', 'estatus')->where('estatus', 'Cerrado')->where('prioridad', 'Baja')->count();
        $quejasClientesCSd = QuejasCliente::select('id', 'prioridad', 'estatus')->where('estatus', 'Cerrado')->where('prioridad', null)->count();

        $quejasClientesCanA = QuejasCliente::select('id', 'prioridad', 'estatus')->where('estatus', 'No procedente')->where('prioridad', 'Alta')->count();
        $quejasClientesCanM = QuejasCliente::select('id', 'prioridad', 'estatus')->where('estatus', 'No procedente')->where('prioridad', 'Media')->count();
        $quejasClientesCanB = QuejasCliente::select('id', 'prioridad', 'estatus')->where('estatus', 'No procedente')->where('prioridad', 'Baja')->count();
        $quejasClientesCanSd = QuejasCliente::select('id', 'prioridad', 'estatus')->where('estatus', 'No procedente')->where('prioridad', null)->count();

        $quejaEstatusAltaArray = [$quejasClientesSaA, $quejasClientesEcA, $quejasClientesEeA, $quejasClientesCA, $quejasClientesCanA];
        $quejaEstatusMediaArray = [$quejasClientesSaM, $quejasClientesEcM, $quejasClientesEeM, $quejasClientesCM, $quejasClientesCanM];
        $quejaEstatusBajaArray = [$quejasClientesSaB, $quejasClientesEcB, $quejasClientesEeB, $quejasClientesCB, $quejasClientesCanB];
        $quejaEstatusSinDArray = [$quejasClientesSaSd, $quejasClientesEcSd, $quejasClientesEeSd, $quejasClientesCSd, $quejasClientesCanSd];

        $quejaPrioridadA = QuejasCliente::select('id', 'prioridad')->where('prioridad', 'Alta')->count();
        $quejaPrioridadM = QuejasCliente::select('id', 'prioridad')->where('prioridad', 'Media')->count();
        $quejaPrioridadB = QuejasCliente::select('id', 'prioridad')->where('prioridad', 'Baja')->count();

        $quejaAcSolicitada = QuejasCliente::select('id', 'desea_levantar_ac')->where('desea_levantar_ac', true)->count();
        $quejaAcNoSolicitada = QuejasCliente::select('id', 'desea_levantar_ac')->where('desea_levantar_ac', false)->count();

        $quejaCanalCorreoE = QuejasCliente::select('id', 'canal')->where('canal', 'Correo electronico')->count();
        $quejaCanalTelefono = QuejasCliente::select('id', 'canal')->where('canal', 'Via telefonica')->count();
        $quejaCanalPresencial = QuejasCliente::select('id', 'canal')->where('canal', 'Presencial')->count();
        $quejaCanalRemota = QuejasCliente::select('id', 'canal')->where('canal', 'Remota')->count();
        $quejaCanalOficio = QuejasCliente::select('id', 'canal')->where('canal', 'Oficio')->count();
        $quejaCanalOtro = QuejasCliente::select('id', 'canal')->where('canal', 'Otro')->count();

        $quejaCategoriaServNoP = QuejasCliente::select('id', 'categoria_queja')->where('categoria_queja', 'Servicio no prestado')->count();
        $quejaCategoriaRetrasoP = QuejasCliente::select('id', 'categoria_queja')->where('categoria_queja', 'Retraso en la prestacion')->count();
        $quejaCategoriaEntreNoC = QuejasCliente::select('id', 'categoria_queja')->where('categoria_queja', 'Entregable no conforme')->count();
        $quejaCategoriaIncuComC = QuejasCliente::select('id', 'categoria_queja')->where('categoria_queja', 'Incumplimiento de los compromisos contractuales')->count();
        $quejasCategoriaIncuNivServ = QuejasCliente::select('id', 'categoria_queja')->where('categoria_queja', 'Incumplimiento de los niveles de servicio')->count();
        $quejasCategoriaNegPresServ = QuejasCliente::select('id', 'categoria_queja')->where('categoria_queja', 'Negativa de prestación del servicio')->count();
        $quejasCategoriaIncFact = QuejasCliente::select('id', 'categoria_queja')->where('categoria_queja', 'Incorrecta facturacion')->count();
        $quejasCategoriaOtro = QuejasCliente::select('id', 'categoria_queja')->where('categoria_queja', 'Otro')->count();

        $quejaCumplioFecha = QuejasCliente::select('id', 'cumplio_fecha')->where('cumplio_fecha', true)->count();
        $quejaNoCumplioFecha = QuejasCliente::select('id', 'cumplio_fecha')->where('cumplio_fecha', false)->count();

        $areasCollect = [];
        $areas = [];
        $ticketPorArea = QuejasCliente::select('area_quejado')->get();
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
        $ticketPorProceso = QuejasCliente::select('proceso_quejado')->get();

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
        $proyectos = TimesheetProyecto::select('id', 'proyecto', 'cliente_id')->with('cliente')->find($quejasproyectos);
        $proyectosLabel = [];
        foreach ($proyectos as $proyecto) {
            // dd($proyecto);
            $cantidad = QuejasCliente::where('proyectos_id', $proyecto->id)->count();
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
            $cantidadClientes = QuejasCliente::where('cliente_id', $cliente->id)->count();
            array_push($clientesLabel, [
                'nombre' => $cliente->nombre,
                'cantidad' => $cantidadClientes,
            ]);
        }

        $total_quejasClientes = QuejasCliente::get()->count();
        $nuevos_quejasClientes = QuejasCliente::where('estatus', 'Sin atender')->get()->count();
        $en_curso_quejasClientes = QuejasCliente::where('estatus', 'En curso')->get()->count();
        $en_espera_quejasClientes = QuejasCliente::where('estatus', 'En espera')->get()->count();
        $cerrados_quejasClientes = QuejasCliente::where('estatus', 'Cerrado')->get()->count();
        $cancelados_quejasClientes = QuejasCliente::where('estatus', 'No procedente')->get()->count();

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
            if (!is_null($quejasClientes->responsable_atencion_queja_id)) {
                if ($quejasClientes->responsable_atencion_queja_id != auth()->user()->empleado->id) {
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
        // dd($request->all());
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
                'porque_no_cumplio_responsable' =>  'El campo por qué no se cumplieron las acciones es obligatorio',
                'porque_no_cierre_ticket' =>  'El campo por qué no se cierra el ticket es obligatorio',
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
