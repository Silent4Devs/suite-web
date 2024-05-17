<?php

namespace App\Http\Controllers\Admin\RH;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Empleado;
use App\Models\EvaluacionDesempeno;
use App\Models\Organizacion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EvaluacionesDesempenoController extends Controller
{
    public function index()
    {
        $evaluaciones = EvaluacionDesempeno::getAll();
        // dd($evaluaciones);
        return view('admin.recursos-humanos.evaluaciones-desempeno.index', compact('evaluaciones'));
    }

    public function editBorrador($id_evaluacion)
    {
        $evaluaciones = EvaluacionDesempeno::with('periodos', 'evaluados')->find($id_evaluacion);
        dd($evaluaciones);
        return view('admin.recursos-humanos.evaluaciones-desempeno.index', compact('evaluaciones'));
    }

    public function dashboardGeneral()
    {
        return view('admin.recursos-humanos.evaluaciones-desempeno.dashboard-general');
    }

    public function dashboardEvaluacion($id_evaluacion)
    {
        EvaluacionDesempeno::findOrFail($id_evaluacion);
        return view('admin.recursos-humanos.evaluaciones-desempeno.dashboard-evaluacion', compact('id_evaluacion'));
    }

    public function dashboardArea($id_evaluacion, $id_area)
    {
        EvaluacionDesempeno::findOrFail($id_evaluacion);
        return view('admin.recursos-humanos.evaluaciones-desempeno.dashboard-area', compact('id_evaluacion', 'id_area'));
    }

    public function dashboardEvaluado($id_evaluacion, $id_evaluado)
    {
        EvaluacionDesempeno::findOrFail($id_evaluacion);
        return view('admin.recursos-humanos.evaluaciones-desempeno.dashboard-evaluado', compact('id_evaluacion', 'id_evaluado'));
    }

    public function dashboardGlobal()
    {
        return view('admin.recursos-humanos.evaluaciones-desempeno.dashboard-global');
    }

    public function configEvaluaciones()
    {
        return view('admin.recursos-humanos.evaluaciones-desempeno.config-evaluaciones-cards');
    }

    public function createEvaluacion()
    {
        $areas = Area::getIdNameAll();
        $empleados = Empleado::getIDaltaAll();

        return view('admin.recursos-humanos.evaluaciones-desempeno.create-evaluacion', compact('areas', 'empleados'));
    }

    public function cuestionarioEvaluacionDesempeno($evaluacion, $evaluado, $periodo)
    {
        $currentUser = User::getCurrentUser()->empleado;

        $evaluacionDesempeno = EvaluacionDesempeno::findOrFail($evaluacion);
        $evaluado = $evaluacionDesempeno->evaluados()->find($evaluado);

        if (empty($evaluacionDesempeno) || empty($evaluado)) {
            return redirect()->route('admin.inicio-Usuario.index');
        }

        $evaluadoresObjetivos = $evaluado->evaluadoresObjetivos($periodo)->pluck('evaluador_desempeno_id')->toArray();
        $evaluadoresCompetencias = $evaluado->evaluadoresCompetencias($periodo)->pluck('evaluador_desempeno_id')->toArray();
        $acceso_objetivos = in_array($currentUser->id, $evaluadoresObjetivos);
        $acceso_competencias = in_array($currentUser->id, $evaluadoresCompetencias);

        if (!$acceso_objetivos && !$acceso_competencias) {
            return redirect()->route('admin.inicio-Usuario.index');
        }

        return view('admin.recursos-humanos.evaluaciones-desempeno.cuestionario', compact(
            'evaluacionDesempeno',
            'evaluado',
            'periodo',
            'acceso_objetivos',
            'acceso_competencias'
        ));
    }

    public function misEvaluaciones()
    {
        return view('admin.recursos-humanos.evaluaciones-desempeno.mis-evaluaciones');
    }

    public function cargaObjetivosEmpleado($id_empleado)
    {
        $empleado = Empleado::getaltaAllWithAreaObjetivoPerfil()->find($id_empleado);
        $organizacion = Organizacion::first();
        // dd($empleado);
        return view('admin.recursos-humanos.evaluaciones-desempeno.carga-objetivos-empleado', compact('empleado', 'organizacion'));
    }

    public function objetivosImportar()
    {
        return view('admin.recursos-humanos.evaluaciones-desempeno.objetivos-importar');
    }

    public function objetivosPapelera($id_empleado)
    {
        $empleado = Empleado::getaltaAllWithAreaObjetivoPerfil()->find($id_empleado);
        // dd($empleado);
        return view('admin.recursos-humanos.evaluaciones-desempeno.objetivos-papelera', compact('empleado'));
    }

    public function objetivosExportar()
    {
        return view('admin.recursos-humanos.evaluaciones-desempeno.objetivos-exportar');
    }

    public function destroy($id_evaluacion)
    {
        // dd($id_evaluacion);
        $evBorrar = EvaluacionDesempeno::find($id_evaluacion);
        $evBorrar->delete();
    }

    public function storeFirmasEvaluacion($id_ev, $id_evaluado, Request $request)
    {
        // dd("Llega", $id_ev, $id_evaluado, $request);

        $evaluacion = EvaluacionDesempeno::find($id_ev);
        $evaluador = auth()->user()->empleado->name;
        $evaluado = Empleado::getAltaEmpleados()->find($id_evaluado);

        $signatureEvaluado = $request->input('signatureEvaluado');
        $signatureEvaluador = $request->input('signatureEvaluador');

        $imageEvaluado = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $signatureEvaluado));
        $imageEvaluador = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $signatureEvaluador));

        if (!Storage::exists('public/evaluacionesDesempeno/evaluacion/' . $evaluacion->id . '/evaluados')) {
            Storage::makeDirectory('public/evaluacionesDesempeno/evaluacion/' . $evaluacion->id . '/evaluados' . '/' . $evaluacion->id . '/nombre', 0755, true);
        }

        $filenameEvaluado = '/evaluacion' . $evaluacion->id . 'firmaevaluado' . '.png';
        $filenameEvaluador = '/evaluacion' . $evaluacion->id . 'firmaevaluador' . '.png';

        Storage::put('public/evaluacionesDesempeno/evaluacion/' . $evaluacion->id . '/reporte' . '/' . $evaluacion->id . '/nombre' . $filenameEvaluado, $imageEvaluado);
        Storage::put('public/evaluacionesDesempeno/evaluacion/' . $evaluacion->id . '/reporte' . '/' . $evaluacion->id . '/nombre' . $filenameEvaluador, $imageEvaluador);

        // dd($evaluacion);
        // $evaluacion->update([
        //     // "comentarios",
        //     'estado' => 'enviado',
        //     'firma_empleado' => $filename,
        //     // "firma_lider",
        // ]);

        // $url = $evaluacion->id_auditoria;

        // try {
        //     $email = new NotificacionReporteAuditoria($nombre_colaborador, $url);
        //     Mail::to(removeUnicodeCharacters($evaluacion->lider->email))->queue($email);

        //     return response()->json(['success' => true]);
        // } catch (Throwable $e) {
        //     return response()->json(['success' => false]);
        // }
    }
}
