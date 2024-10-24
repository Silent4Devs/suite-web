<?php

namespace App\Http\Controllers\Admin;

use App\Events\RiesgosEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRiesgosRequest;
use App\Models\Activo;
use App\Models\AnalisisSeguridad;
use App\Models\AprobadorSeleccionado;
use App\Models\Area;
use App\Models\Empleado;
use App\Models\EvidenciasRiesgo;
use App\Models\FirmaCentroAtencion;
use App\Models\FirmaModule;
use App\Models\Organizacion;
use App\Models\Proceso;
use App\Models\RiesgoIdentificado;
use App\Models\Sede;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use App\Services\SentimentService;

// CENTRO DE ATENCION: Controlador de riesgos
class RiesgosController extends Controller
{
    public function riesgos()
    {
        abort_if(Gate::denies('mi_perfil_mis_reportes_realizar_reporte_de_riesgo_identificado'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $areas = Area::getIdNameAll();

        $procesos = Proceso::getAll();

        $activos = Activo::getAll();

        $empleados = Empleado::getIDaltaAll();

        $sedes = Sede::getAll();

        return view('admin.inicioUsuario.formularios.riesgos', compact('activos', 'areas', 'procesos', 'sedes'));
    }

    public function storeRiesgos(StoreRiesgosRequest $request)
    {
        abort_if(Gate::denies('mi_perfil_mis_reportes_realizar_reporte_de_riesgo_identificado'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sentimientos = json_encode(SentimentService::analyzeSentiment($request->descripcion));

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
            'empleado_reporto_id' => User::getCurrentUser()->empleado->id,
            'sentimientos' => $sentimientos,
        ]);

        AnalisisSeguridad::create([
            'riesgos_id' => $riesgos->id,
            'formulario' => 'riesgo',
        ]);

        $image = null;

        if ($request->file('evidencia') != null or ! empty($request->file('evidencia'))) {
            foreach ($request->file('evidencia') as $file) {
                $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);

                $name_image = basename(pathinfo($file->getClientOriginalName(), PATHINFO_BASENAME), '.'.$extension);

                $new_name_image = 'Riesgo_file_'.$riesgos->id.'_'.$name_image.'.'.$extension;

                $route = 'public/evidencias_riesgos';

                $image = $new_name_image;

                $file->storeAs($route, $image);

                EvidenciasRiesgo::create([
                    'evidencia' => $image,
                    'id_riesgos' => $riesgos->id,
                ]);
            }
        }

        return redirect()->route('admin.desk.index')->with('success', 'Reporte generado');
    }

    public function indexRiesgo()
    {
        abort_if(Gate::denies('centro_atencion_riesgos_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $riesgo = RiesgoIdentificado::with('reporto:id,name,foto')->where('archivado', false)->get();

        return datatables()->of($riesgo)->toJson();
    }

    public function editRiesgos(Request $request, $id_riesgos)
    {
        abort_if(Gate::denies('centro_atencion_riesgos_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $modulo = 1;

        $submodulo = 4;

        $riesgos = RiesgoIdentificado::findOrfail(intval($id_riesgos))->load('evidencias_riesgos')->load('reporto');

        $analisis = AnalisisSeguridad::where('formulario', '=', 'riesgo')->where('riesgos_id', intval($id_riesgos))->first();
        if (is_null($analisis)) {
            $analisis = collect();
        }
        $procesos = Proceso::getAll();

        $activos = Activo::getAll();

        $areas = Area::getIdNameAll();

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

        $aprobadorSeleccionado = new AprobadorSeleccionado;

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

        $fecha = $request->estatus === 'cancelado' ? Carbon::now()->format('Y-m-d H:i:s') : ($request->estatus === 'cerrado' ? Carbon::now()->format('Y-m-d H:i:s') : null);

        $riesgos->update([
            'titulo' => $request->titulo,
            'fecha' => $request->fecha,
            'estatus' => $request->estatus,
            'fecha_cierre' => $fecha,
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

            $aprobadorSeleccionado = new AprobadorSeleccionado;

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

            event(new RiesgosEvent($riesgos, 'update', 'riesgos_identificados', 'Riesgo'));
        }

        return redirect()->route('admin.desk.index')->with('success', 'Reporte actualizado');
    }

    public function removeUnicodeCharacters($string)
    {
        return preg_replace('/[^\x00-\x7F]/u', '', $string);
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
            RiesgoIdentificado::where('id', $incidente)->update(['archivado' => true]);

            \Artisan::call('optimize:clear');

            \Artisan::call('cache:clear');

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
        RiesgoIdentificado::where('id', $id)->update(['archivado' => false]);

        \Artisan::call('cache:clear');

        return redirect()->route('admin.desk.index');
    }
}
