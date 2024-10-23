<?php

namespace App\Http\Controllers\Admin;

use App\Events\QuejasEvent;
use App\Http\Controllers\Controller;
use App\Mail\SolicitudAprobacion;
use App\Models\Activo;
use App\Models\AnalisisSeguridad;
use App\Models\AprobadorSeleccionado;
use App\Models\Area;
use App\Models\Empleado;
use App\Models\EvidenciasQueja;
use App\Models\FirmaCentroAtencion;
use App\Models\FirmaModule;
use App\Models\Organizacion;
use App\Models\Proceso;
use App\Models\Quejas;
use App\Models\Sede;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use App\Services\SentimentService;

class QuejasController extends Controller
{
    public function quejas()
    {
        abort_if(Gate::denies('mi_perfil_mis_reportes_realizar_reporte_de_queja'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $areas = Area::getIdNameAll();

        $procesos = Proceso::getAll();

        $activos = Activo::getAll();

        $empleados = Empleado::getIdNameAll();

        $sedes = Sede::getAll();

        return view('admin.inicioUsuario.formularios.quejas', compact('areas', 'procesos', 'empleados', 'activos', 'sedes'));
    }

    public function removeUnicodeCharacters($string)
    {
        return preg_replace('/[^\x00-\x7F]/u', '', $string);
    }

    public function storeQuejas(Request $request)
    {
        abort_if(Gate::denies('mi_perfil_mis_reportes_realizar_reporte_de_queja'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'titulo' => 'required|max:255',
            'ubicacion' => 'required|max:255',
            'descripcion' => 'required|max:550',
        ], [
            'titulo.max' => 'El campo título no puede exceder los 255 caracteres.',
            'ubicacion.max' => 'El campo ubicación no puede exceder los 255 caracteres.',
            'descripcion.max' => 'El campo descripción no puede exceder los 550 caracteres.',
        ]);

        $sentimientos = json_encode(SentimentService::analyzeSentiment($request->descripcion));

        $quejas = Quejas::create([
            'anonimo' => $request->anonimo,
            'empleado_quejo_id' => User::getCurrentUser()->empleado->id,

            'area_quejado' => $request->area_quejado,
            'colaborador_quejado' => $request->colaborador_quejado,
            'proceso_quejado' => $request->proceso_quejado,
            'externo_quejado' => $request->externo_quejado,

            'titulo' => $request->titulo,
            'fecha' => $request->fecha,
            'sede' => $request->sede,
            'ubicacion' => $request->ubicacion,
            'descripcion' => $request->descripcion,
            'estatus' => 'nuevo',
            'sentimientos' => $sentimientos,
        ]);

        AnalisisSeguridad::create([
            'quejas_id' => $quejas->id,
            'formulario' => 'queja',
        ]);

        $image = null;

        if ($request->file('evidencia') != null or ! empty($request->file('evidencia'))) {
            foreach ($request->file('evidencia') as $file) {
                $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);

                $name_image = basename(pathinfo($file->getClientOriginalName(), PATHINFO_BASENAME), '.'.$extension);

                $new_name_image = 'Queja_file_'.$quejas->id.'_'.$name_image.'.'.$extension;

                $route = 'public/evidencias_quejas';

                $image = $new_name_image;

                $file->storeAs($route, $image);

                EvidenciasQueja::create([
                    'evidencia' => $image,
                    'id_quejas' => $quejas->id,
                ]);
            }
        }

        return redirect()->route('admin.desk.index')->with('success', 'Reporte generado');
    }

    public function indexQueja()
    {
        abort_if(Gate::denies('centro_atencion_quejas_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $quejas = Quejas::select('empleado_quejo_id', 'id', 'titulo', 'fecha', 'fecha_cierre', 'estatus', 'sede', 'ubicacion', 'descripcion', 'area_quejado', 'colaborador_quejado', 'proceso_quejado', 'externo_quejado')->with('quejo:id,name,foto')->where('archivado', false)->get();

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

        $areas = Area::getIdNameAll();

        $sedes = Sede::getAll();

        $empleados = Empleado::getIdNameAll();

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

        $aprobadorSeleccionado = new AprobadorSeleccionado;

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

        $fecha = $request->estatus === 'cancelado' ? Carbon::now()->format('Y-m-d H:i:s') : ($request->estatus === 'cerrado' ? Carbon::now()->format('Y-m-d H:i:s') : null);

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
            'fecha_cierre' => $fecha,

        ]);

        if ($quejas->estatus === 'cerrado' || $quejas->estatus === 'cancelado') {

            $existingRecord = AprobadorSeleccionado::where('quejas_id', $quejas->id)->first();

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
            $aprobadorSeleccionado->sugerencias_id = null;
            $aprobadorSeleccionado->quejas_id = $quejas->id;
            $aprobadorSeleccionado->denuncias_id = null;
            $aprobadorSeleccionado->aprobadores = json_encode($request->participantes);

            $aprobadorSeleccionado->save();

            // Enviar correos electrónicos
            foreach ($empleados as $empleado) {
                Mail::to(trim($this->removeUnicodeCharacters($empleado->email)))->queue(new SolicitudAprobacion($empleado, $status, $quejas->id, $organizacion));
            }

            event(new QuejasEvent($quejas, 'update', 'quejas', 'Queja'));
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
            Quejas::where('id', $incidente)->update(['archivado' => true]);

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
        Quejas::where('id', $id)->update(['archivado' => false]);

        return redirect()->route('admin.desk.index');
    }
}
