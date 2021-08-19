<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

use App\Models\IncidentesSeguridad;
use App\Models\RiesgoIdentificado;
use App\Models\Quejas;
use App\Models\Denuncias;
use App\Models\Mejoras;
use App\Models\Sugerencias;
use App\Models\EvidenciasQueja;

use App\Models\Empleado;
use App\Models\Activo;
use App\Models\Proceso;
use App\Models\Area;
use App\Models\Sede;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class DeskController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('centro_atencion_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $incidentes_seguridad = IncidentesSeguridad::where('archivado', IncidentesSeguridad::NO_ARCHIVADO)->get();
        $riesgos_identificados = RiesgoIdentificado::get();
        $quejas = Quejas::get();
        $denuncias = Denuncias::get();
        $mejoras = Mejoras::get();
        $sugerencias = Sugerencias::get();

        $total = IncidentesSeguridad::get()->count();
        $nuevos = IncidentesSeguridad::where('estatus', 'nuevo')->get()->count();
        $en_curso = IncidentesSeguridad::where('estatus', 'en curso')->get()->count();
        $en_espera = IncidentesSeguridad::where('estatus', 'en espera')->get()->count();
        $cerrados = IncidentesSeguridad::where('estatus', 'cerrado')->get()->count();
        $cancelados = IncidentesSeguridad::where('estatus', 'cancelado')->get()->count();

        return view('admin.desk.index', compact('incidentes_seguridad', 'total', 'nuevos', 'en_curso', 'en_espera', 'cerrados', 'cancelados', 'riesgos_identificados', 'quejas', 'denuncias', 'mejoras', 'sugerencias'));
    }

    

    public function indexSeguridad()
    {
        $incidentes_seguridad = IncidentesSeguridad::with('asignado', 'reporto')->where('archivado', IncidentesSeguridad::NO_ARCHIVADO)->get();

        return datatables()->of($incidentes_seguridad)->toJson();
    }
    public function editSeguridad(Request $request, $id_incidente)
    {

        $incidentesSeguridad = IncidentesSeguridad::findOrfail(intval($id_incidente));

        $activos = Activo::get();

        $empleados = Empleado::get();

        $sedes = Sede::get();

        $areas = Area::get();

        $procesos = Proceso::get();

        return view('admin.desk.seguridad.edit', compact('incidentesSeguridad', 'activos', 'empleados', 'sedes', 'areas', 'procesos'));
    }
    public function updateSeguridad(Request $request, $id_incidente)
    {
        $incidentesSeguridad = IncidentesSeguridad::findOrfail(intval($id_incidente));
        $incidentesSeguridad->update([
            'titulo' => $request->titulo,
            'estatus' => $request->estatus,
            'fecha' => $request->fecha,
            'empleado_asignado_id' => $request->empleado_asignado_id,
            'categoria' => $request->categoria,
            'subcategoria' => $request->subcategoria,
            'sede' => $request->sede,
            'ubicacion' => $request->ubicacion,
            'descripcion' => $request->descripcion,

            'areas_afectados' => $request->areas_afectados,
            'procesos_afectados' => $request->procesos_afectados,
            'activos_afectados' => $request->activos_afectados,

            'empleado_reporto_id' => $incidentesSeguridad->empleado_reporto_id,

            'urgencia' => $request->urgencia,
            'impacto' => $request->impacto,
            'prioridad' => $request->prioridad,
            'comentarios' => $request->comentarios,
        ]);


        return redirect()->route('admin.desk.index');
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




    public function editRiesgos(Request $request, $id_riesgos)
    {

        $riesgos = RiesgoIdentificado::findOrfail(intval($id_riesgos));

        $procesos = Proceso::get();

        $activos = Activo::get();

        $areas = Area::get();

        $sedes = Sede::get();

        $empleados = Empleado::get();

        return view('admin.desk.riesgos.edit', compact('riesgos', 'procesos', 'empleados', 'areas', 'activos', 'sedes'));
    }
    public function updateRiesgos(Request $request, $id_riesgos)
    {
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


        return redirect()->route('admin.desk.index');
    }




    public function editQuejas(Request $request, $id_quejas)
    {

        $quejas = Quejas::findOrfail(intval($id_quejas))->load('evidencias_quejas');

        $procesos = Proceso::get();

        $activos = Activo::get();

        $areas = Area::get();

        $sedes = Sede::get();

        $empleados = Empleado::get();

        return view('admin.desk.quejas.edit', compact('quejas', 'procesos', 'empleados', 'areas', 'activos', 'sedes'));
    }
    public function updateQuejas(Request $request, $id_quejas)
    {
        $quejas = Quejas::findOrfail(intval($id_quejas));
        $quejas->update([
            'titulo' => $request->titulo,
            'estatus' => $request->estatus,
            'fecha' => $request->fecha,
            'sede' => $request->sede,
            'ubicacion' => $request->ubicacion,
            'descripcion' => $request->descripcion,
            'areas_quejado' => $request->areas_afectados,
            'colaborador_quejado' => $request->colaborador_quejado,
            'procesos_quejado' => $request->procesos_quejado,
            'externo_quejado' => $request->externo_quejado,
            'comentarios' => $request->comentarios,
        ]);


        return redirect()->route('admin.desk.index');
    }





    public function editDenuncias(Request $request, $id_denuncias)
    {

        $denuncias = Denuncias::findOrfail(intval($id_denuncias));

        $activos = Activo::get();

        $empleados = Empleado::get();

        return view('admin.desk.denuncias.edit', compact('denuncias', 'activos', 'empleados'));
    }
    public function updateDenuncias(Request $request, $id_denuncias)
    {
        $denuncias = Denuncias::findOrfail(intval($id_denuncias));
        $denuncias->update([
            'anonimo' => $request->anonimo,
            'descripcion' => $request->descripcion,
            'evidencia' => $request->evidencia,
            'denunciado' => $request->denunciado,
            'area_denunciado' => $request->area_denunciado,
            'tipo' => $request->tipo,
        ]);


        return redirect()->route('admin.desk.index');
    }






    public function editMejoras(Request $request, $id_mejoras)
    {

        $mejoras = Mejoras::findOrfail(intval($id_mejoras));

        $activos = Activo::get();

        $empleados = Empleado::get();

        return view('admin.desk.mejoras.edit', compact('mejoras', 'activos', 'empleados'));
    }
    public function updateMejoras(Request $request, $id_mejoras)
    {
        $mejoras = Mejoras::findOrfail(intval($id_mejoras));
        $mejoras->update([
            'descripcion' => $request->descripcion,
            'mejora' => $request->mejora,
        ]);

        return redirect()->route('admin.desk.index');
    }





    public function editSugerencias(Request $request, $id_sugerencias)
    {

        $sugerencias = Sugerencias::findOrfail(intval($id_sugerencias));

        $activos = Activo::get();

        $empleados = Empleado::get();

        return view('admin.desk.sugerencias.edit', compact('sugerencias', 'activos', 'empleados'));
    }
    public function updateSugerencias(Request $request, $id_sugerencias)
    {
        $sugerencias = Sugerencias::findOrfail(intval($id_sugerencias));
        $sugerencias->update([
            'empleado_sugerir_id' => auth()->user()->empleado->id,
            'descripcion' => $request->descripcion,
            'sugerencia_dirigida' => $request->sugerencia_dirigida,
        ]);

        return redirect()->route('admin.desk.index');
    }
}
