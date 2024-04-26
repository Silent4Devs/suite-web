<?php

namespace App\Http\Controllers\Admin\RH;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Empleado;
use App\Models\EvaluacionDesempeno;
use App\Models\User;
use Illuminate\Http\Request;

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
        return view('admin.recursos-humanos.evaluaciones-desempeno.dashboard-evaluacion', compact('id_evaluacion'));
    }

    public function dashboardArea($id_evaluacion, $id_area)
    {
        return view('admin.recursos-humanos.evaluaciones-desempeno.dashboard-area', compact('id_evaluacion', 'id_area'));
    }

    public function dashboardEvaluado($id_evaluacion, $id_evaluado)
    {
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

    public function cuestionarioEvaluacionDesempeno($evaluacion, $evaluado)
    {
        $currentUser = User::getCurrentUser()->empleado;

        $evaluacionDesempeno = EvaluacionDesempeno::findOrFail($evaluacion);
        $evaluado = $evaluacionDesempeno->evaluados()->find($evaluado);

        if (empty($evaluacionDesempeno) || empty($evaluado)) {
            return redirect()->route('admin.inicio-Usuario.index');
        }

        $evaluadoresObjetivos = $evaluado->evaluadoresObjetivos()->pluck('evaluador_desempeno_id')->toArray();
        $evaluadoresCompetencias = $evaluado->evaluadoresCompetencias()->pluck('evaluador_desempeno_id')->toArray();

        $acceso_objetivos = in_array($currentUser->id, $evaluadoresObjetivos);
        $acceso_competencias = in_array($currentUser->id, $evaluadoresCompetencias);

        if (!$acceso_objetivos && !$acceso_competencias) {
            return redirect()->route('admin.inicio-Usuario.index');
        }

        return view('admin.recursos-humanos.evaluaciones-desempeno.cuestionario', compact(
            'evaluacionDesempeno',
            'evaluado',
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
        // dd($empleado);
        return view('admin.recursos-humanos.evaluaciones-desempeno.carga-objetivos-empleado', compact('empleado'));
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
}
