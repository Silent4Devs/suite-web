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
use App\Models\SubcategoriaIncidente;
use App\Models\CategoriaIncidente;
use App\Models\AnalisisSeguridad;

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

        $incidentesSeguridad = IncidentesSeguridad::findOrfail(intval($id_incidente))->load('evidencias_seguridad');

        // $incidentesSeguridad = IncidentesSeguridad::findOrfail(intval($id_incidente));

        $analisis = AnalisisSeguridad::where('formulario', '=', 'seguridad')->where("seguridad_id", intval($id_incidente))->first();

        $activos = Activo::get();

        $empleados = Empleado::get();

        $sedes = Sede::get();

        $areas = Area::get();

        $procesos = Proceso::get();

        $subcategorias = SubcategoriaIncidente::get();

        $categorias = CategoriaIncidente::get();

        return view('admin.desk.seguridad.edit', compact('incidentesSeguridad', 'activos', 'empleados', 'sedes', 'areas', 'procesos', 'subcategorias', 'categorias', 'analisis'));
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


        return redirect()->route('admin.desk.seguridad-edit', $id_incidente);
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


        return redirect()->route('admin.desk.seguridad-edit', $analisis_seguridad->seguridad_id);
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

        // $analisis = AnalisisSeguridad::where('formulario', '=', 'riesgo')->findOrfail(intval($id_riesgos));

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


        return redirect()->route('admin.desk.riesgos-edit', $id_riesgos);
    }




    public function editQuejas(Request $request, $id_quejas)
    {

        $quejas = Quejas::findOrfail(intval($id_quejas))->load('evidencias_quejas');

        $procesos = Proceso::get();

        $activos = Activo::get();

        $analisis = AnalisisSeguridad::where('formulario', '=', 'queja')->where("quejas_id", intval($id_quejas))->first();

        $areas = Area::get();

        $sedes = Sede::get();

        $empleados = Empleado::get();

        return view('admin.desk.quejas.edit', compact('quejas', 'procesos', 'empleados', 'areas', 'activos', 'sedes', 'analisis'));
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
        ]);


        return redirect()->route('admin.desk.quejas-edit', $analisis_seguridad->quejas_id);
    }





    public function editDenuncias(Request $request, $id_denuncias)
    {

        $analisis = AnalisisSeguridad::where('formulario', '=', 'denuncia')->where("denuncias_id", intval($id_denuncias))->first();

        $denuncias = Denuncias::findOrfail(intval($id_denuncias));

        $activos = Activo::get();

        $empleados = Empleado::get();

        return view('admin.desk.denuncias.edit', compact('denuncias', 'activos', 'empleados', 'analisis'));
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


        return redirect()->route('admin.desk.denuncias-edit', $analisis_seguridad->denuncias_id);
    }






    public function editMejoras(Request $request, $id_mejoras)
    {

        $mejoras = Mejoras::findOrfail(intval($id_mejoras));

        $activos = Activo::get();

        $empleados = Empleado::get();

        $areas = Area::get();

        $procesos = Proceso::get();

        $analisis = AnalisisSeguridad::where('formulario', '=', 'mejora')->where("mejoras_id", intval($id_mejoras))->first();


        return view('admin.desk.mejoras.edit', compact('mejoras', 'activos', 'empleados', 'areas', 'procesos', 'analisis'));
    }
    public function updateMejoras(Request $request, $id_mejoras)
    {
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

        return redirect()->route('admin.desk.index');
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
        ]);


        return redirect()->route('admin.desk.mejoras-edit', $analisis_seguridad->mejoras_id);
    }





    public function editSugerencias(Request $request, $id_sugerencias)
    {

        $sugerencias = Sugerencias::findOrfail(intval($id_sugerencias));

        $activos = Activo::get();

        $empleados = Empleado::get();

        $areas = Area::get();

        $procesos = Proceso::get();



        $analisis = AnalisisSeguridad::where('formulario', '=', 'sugerencia')->where("sugerencias_id", intval($id_sugerencias))->first();

        

        return view('admin.desk.sugerencias.edit', compact('sugerencias', 'activos', 'empleados', 'areas', 'procesos', 'analisis'));
    }
    public function updateSugerencias(Request $request, $id_sugerencias)
    {
        $sugerencias = Sugerencias::findOrfail(intval($id_sugerencias));
        $sugerencias->update([
            'area_sugerencias' => $request->area_sugerencias,
            'proceso_sugerencias' => $request->proceso_sugerencias,

            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,

            'estatus' => $request->estatus,

            'fecha_cierre' => $request->fecha_cierre,
        ]);

        return redirect()->route('admin.desk.index');
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


        return redirect()->route('admin.desk.sugerencias-edit', $analisis_seguridad->sugerencias_id);
    }
}
