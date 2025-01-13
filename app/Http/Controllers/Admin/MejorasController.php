<?php

namespace App\Http\Controllers\Admin;

use App\Events\MejorasEvent;
use App\Http\Controllers\Controller;
use App\Mail\SolicitudAprobacion;
use App\Models\Activo;
use App\Models\AnalisisSeguridad;
use App\Models\AprobadorSeleccionado;
use App\Models\Area;
use App\Models\Empleado;
use App\Models\FirmaCentroAtencion;
use App\Models\FirmaModule;
use App\Models\Mejoras;
use App\Models\Organizacion;
use App\Models\Proceso;
use App\Models\User;
use App\Services\SentimentService;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

// CENTRO DE ATENCION: MejorasController
class MejorasController extends Controller
{
    public function mejoras()
    {
        abort_if(Gate::denies('mi_perfil_mis_reportes_realizar_reporte_de_propuesta_de_mejora'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $areas = Area::getIdNameAll();

        $procesos = Proceso::getAll();

        return view('admin.inicioUsuario.formularios.mejoras', compact('areas', 'procesos'));
    }

    public function storeMejoras(Request $request)
    {
        abort_if(Gate::denies('mi_perfil_mis_reportes_realizar_reporte_de_propuesta_de_mejora'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'area_mejora' => 'nullable|string',
            'proceso_mejora' => 'nullable|string',
            'titulo' => 'required',
            'tipo' => 'required',
            'descripcion' => 'required',
            'beneficios' => 'required',
        ]);

        $sentimientos = json_encode(SentimentService::analyzeSentiment($request->descripcion));

        $mejoras = Mejoras::create([
            'empleado_mejoro_id' => optional(User::getCurrentUser()->empleado)->id ?? '',
            'descripcion' => $request->descripcion,
            'beneficios' => $request->beneficios,
            'titulo' => $request->titulo,
            'area_mejora' => $request->area_mejora,
            'proceso_mejora' => $request->proceso_mejora,
            'tipo' => $request->tipo,
            'otro' => $request->otro,
            'estatus' => 'nuevo',
            'sentimientos' => $sentimientos,
        ]);

        AnalisisSeguridad::create([
            'mejoras_id' => $mejoras->id,
            'formulario' => 'mejora',
        ]);

        return redirect()->route('admin.desk.index')->with('success', 'Reporte generado');
    }

    public function indexMejora()
    {
        abort_if(Gate::denies('centro_atencion_mejoras_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mejoras = Mejoras::getAll();

        return datatables()->of($mejoras)->toJson();
    }

    public function editMejoras(Request $request, $id_mejoras)
    {

        abort_if(Gate::denies('centro_atencion_mejoras_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $modulo = 1;

        $submodulo = 2;

        $mejoras = Mejoras::where('id', intval($id_mejoras))->first();
        // dd($id_mejoras, $mejoras);

        $activos = Activo::getAll();

        $empleados = Empleado::getIdNameAll();

        $aprobadores = AprobadorSeleccionado::where('mejoras_id', $mejoras->id)->first();

        $aprobadoresArray = [];

        if ($aprobadores) {
            // Convierte el campo aprobadores de JSON a array
            $aprobadoresArray = json_decode($aprobadores->aprobadores, true);
        }

        $areas = Area::getIdNameAll();

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

        $aprobadorSeleccionado = new AprobadorSeleccionado;

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

            $aprobadorSeleccionado = new AprobadorSeleccionado;

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

            event(new MejorasEvent($mejoras, 'update', 'mejoras', 'Mejora'));
        }

        // return redirect()->route('admin.desk.mejoras-edit', $id_mejoras)->with('success', 'Reporte actualizado');
        return redirect()->route('admin.desk.index')->with('success', 'Reporte actualizado');
    }

    public function removeUnicodeCharacters($string)
    {
        return preg_replace('/[^\x00-\x7F]/u', '', $string);
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
            Mejoras::where('id', $incidente)->update(['archivado' => true]);

            \Artisan::call('cache:clear');

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
        Mejoras::where('id', $id)->update(['archivado' => false]);

        \Artisan::call('cache:clear');

        return redirect()->route('admin.desk.index');
    }
}
