<?php

namespace App\Http\Controllers\Admin;

use App\Events\DenunciasEvent;
use App\Http\Controllers\Controller;
use App\Models\Activo;
use App\Models\AnalisisSeguridad;
use App\Models\AprobadorSeleccionado;
use App\Models\Denuncias;
use App\Models\Empleado;
use App\Models\EvidenciasDenuncia;
use App\Models\FirmaCentroAtencion;
use App\Models\FirmaModule;
use App\Models\Organizacion;
use App\Models\Sede;
use App\Models\User;
use App\Services\SentimentService;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class DenunciasController extends Controller
{
    public function denuncias()
    {
        abort_if(Gate::denies('mi_perfil_mis_reportes_realizar_reporte_de_denuncia'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $empleados = Empleado::getIDaltaAll();

        $sedes = Sede::getAll();

        return view('admin.inicioUsuario.formularios.denuncias', compact('empleados', 'sedes'));
    }

    public function removeUnicodeCharacters($string)
    {
        return preg_replace('/[^\x00-\x7F]/u', '', $string);
    }

    public function storeDenuncias(Request $request)
    {
        abort_if(Gate::denies('mi_perfil_mis_reportes_realizar_reporte_de_denuncia'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            'ubicacion' => 'required|max:255',
            'descripcion' => 'required|max:550',
        ], [
            'descripcion.max' => 'El campo título no puede exceder los 550 caracteres.',
            'ubicacion.max' => 'El campo descripción no puede exceder los 255 caracteres.',
        ]);

        $sentimientos = json_encode(SentimentService::analyzeSentiment($request->descripcion));

        $denuncias = Denuncias::create([
            'anonimo' => $request->anonimo,
            'empleado_denuncio_id' => User::getCurrentUser()->empleado->id,
            'descripcion' => $request->descripcion,
            'empleado_denunciado_id' => $request->empleado_denunciado_id,
            'tipo' => $request->tipo,
            'sede' => $request->sede,
            'ubicacion' => $request->ubicacion,
            'fecha' => $request->fecha,
            'estatus' => 'nuevo',
            'sentimientos' => $sentimientos,
        ]);

        AnalisisSeguridad::create([
            'denuncias_id' => $denuncias->id,
            'formulario' => 'denuncia',
        ]);

        $image = null;

        if ($request->file('evidencia') != null or ! empty($request->file('evidencia'))) {
            foreach ($request->file('evidencia') as $file) {
                $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);

                $name_image = basename(pathinfo($file->getClientOriginalName(), PATHINFO_BASENAME), '.'.$extension);

                $new_name_image = 'Denuncia_file_'.$denuncias->id.'_'.$name_image.'.'.$extension;

                $route = 'public/evidencias_denuncias';

                $image = $new_name_image;

                $file->storeAs($route, $image);

                EvidenciasDenuncia::create([
                    'evidencia' => $image,
                    'id_denuncias' => $denuncias->id,
                ]);
            }
        }

        return redirect()->route('admin.desk.index')->with('success', 'Reporte generado');
    }

    public function indexDenuncia()
    {
        abort_if(Gate::denies('centro_atencion_denuncias_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $denuncias = Denuncias::with('denuncio:id,name,foto,email,telefono', 'denunciado:id,name,foto,email,telefono')->where('archivado', false)->get();

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

        $aprobadorSeleccionado = new AprobadorSeleccionado;

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

        $fecha = $request->estatus === 'cancelado' ? Carbon::now()->format('Y-m-d H:i:s') : ($request->estatus === 'cerrado' ? Carbon::now()->format('Y-m-d H:i:s') : null);

        $denuncias->update([
            'anonimo' => $request->anonimo,
            'descripcion' => $request->descripcion,
            'evidencia' => $request->evidencia,
            'denunciado' => $request->denunciado,
            'area_denunciado' => $request->area_denunciado,
            'tipo' => $request->tipo,
            'estatus' => $request->estatus,
            'fecha_cierre' => $fecha,
        ]);

        if ($denuncias->estatus === 'cerrado' || $denuncias->estatus === 'cancelado') {

            $existingRecord = AprobadorSeleccionado::where('denuncias_id', $denuncias->id)->first();

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
            $aprobadorSeleccionado->quejas_id = null;
            $aprobadorSeleccionado->denuncias_id = $denuncias->id;
            $aprobadorSeleccionado->aprobadores = json_encode($request->participantes);

            $aprobadorSeleccionado->save();

            // Enviar correos electrónicos
            foreach ($empleados as $empleado) {
                Mail::to(trim($this->removeUnicodeCharacters($empleado->email)))->queue(new SolicitudAprobacion($empleado, $status, $denuncias->id, $organizacion));
            }

            event(new DenunciasEvent($denuncias, 'update', 'denuncias', 'Denuncia'));
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
            Denuncias::where('id', $incidente)->update(['archivado' => true]);

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
        Denuncias::where('id', $id)->update(['archivado' => false]);

        return redirect()->route('admin.desk.index');
    }
}
