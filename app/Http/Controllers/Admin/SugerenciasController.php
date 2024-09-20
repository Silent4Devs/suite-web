<?php

namespace App\Http\Controllers\Admin;

use App\Events\SugerenciasEvent;
use App\Http\Controllers\Controller;
use App\Mail\SolicitudAprobacion;
use App\Models\Activo;
use App\Models\AnalisisSeguridad;
use App\Models\AprobadorSeleccionado;
use App\Models\Area;
use App\Models\Empleado;
use App\Models\FirmaCentroAtencion;
use App\Models\FirmaModule;
use App\Models\Organizacion;
use App\Models\Proceso;
use App\Models\Sugerencias;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class SugerenciasController extends Controller
{
    public function sugerencias()
    {
        abort_if(Gate::denies('mi_perfil_mis_reportes_realizar_reporte_de_sugerencia'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $areas = Area::getIdNameAll();

        $empleados = Empleado::getIDaltaAll();

        $procesos = Proceso::getAll();

        return view('admin.inicioUsuario.formularios.sugerencias', compact('areas', 'empleados', 'procesos'));
    }

    public function removeUnicodeCharacters($string)
    {
        return preg_replace('/[^\x00-\x7F]/u', '', $string);
    }

    public function storeSugerencias(Request $request)
    {
        abort_if(Gate::denies('mi_perfil_mis_reportes_realizar_reporte_de_sugerencia'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'titulo' => 'required|max:255',
            'descripcion' => 'required|max:550',
        ], [
            'titulo.max' => 'El campo título no puede exceder los 255 caracteres.',
            'descripcion.max' => 'El campo descripción no puede exceder los 550 caracteres.',
        ]);

        $sugerencias = Sugerencias::create([
            'empleado_sugirio_id' => User::getCurrentUser()->empleado->id,

            'area_sugerencias' => $request->area_sugerencias,
            'proceso_sugerencias' => $request->proceso_sugerencias,

            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'estatus' => 'nuevo',
        ]);

        AnalisisSeguridad::create([
            'sugerencias_id' => $sugerencias->id,
            'formulario' => 'sugerencia',
        ]);

        return redirect()->route('admin.desk.index')->with('success', 'Reporte generado');
    }

    public function indexSugerencia()
    {
        abort_if(Gate::denies('centro_atencion_sugerencias_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $riesgo = Sugerencias::with('sugirio:id,name,foto,email')->where('archivado', false)->get();

        return datatables()->of($riesgo)->toJson();
    }

    public function editSugerencias(Request $request, $id_sugerencias)
    {
        abort_if(Gate::denies('centro_atencion_sugerencias_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $modulo = 1;

        $submodulo = 5;

        $sugerencias = Sugerencias::findOrfail(intval($id_sugerencias));

        $activos = Activo::getAll();

        $empleados = Empleado::getIDaltaAll();

        $areas = Area::getIdNameAll();

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

        $aprobadorSeleccionado = new AprobadorSeleccionado;

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

        $fecha = $request->estatus === 'cancelado' ? Carbon::now()->format('Y-m-d H:i:s') : ($request->estatus === 'cerrado' ? Carbon::now()->format('Y-m-d H:i:s') : null);

        $sugerencias->update([
            'area_sugerencias' => $request->area_sugerencias,
            'proceso_sugerencias' => $request->proceso_sugerencias,
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'estatus' => $request->estatus,
            'fecha_cierre' => $fecha,
        ]);

        if ($sugerencias->estatus === 'cerrado' || $sugerencias->estatus === 'cancelado') {

            $existingRecord = AprobadorSeleccionado::where('sugerencias_id', $sugerencias->id)->first();

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

            event(new SugerenciasEvent($sugerencias, 'update', 'sugerencias', 'Sugerencia'));
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
}
