<?php

namespace App\Http\Controllers\Admin\RH;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EvaluacionesDesempeñoController extends Controller
{
    public function index()
    {
    }

    public function dashboardGeneral()
    {
        return view('admin.recursos-humanos.evaluaciones-desempeño.dashboard-general');
    }

    public function dashboardArea()
    {
        return view('admin.recursos-humanos.evaluaciones-desempeño.dashboard-area');
    }

    public function dashboardGlobal()
    {
        return view('admin.recursos-humanos.evaluaciones-desempeño.dashboard-global');
    }

    public function configEvaluaciones()
    {
        return view('admin.recursos-humanos.evaluaciones-desempeño.config-evaluaciones-cards');
    }

    public function createEvaluacion()
    {
        return view('admin.recursos-humanos.evaluaciones-desempeño.create-evaluacion');
    }

    public function dashboardPersonal()
    {
        return view('admin.recursos-humanos.evaluaciones-desempeño.dashboard-personal');
    }

    public function misEvaluaciones()
    {
        return view('admin.recursos-humanos.evaluaciones-desempeño.mis-evaluaciones');
    }

    public function cargaObjetivosEmpleado()
    {
        return view('admin.recursos-humanos.evaluaciones-desempeño.carga-objetivos-empleado');
    }

    public function objetivosImportar()
    {
        return view('admin.recursos-humanos.evaluaciones-desempeño.objetivos-importar');
    }

    public function objetivosPapelera()
    {
        return view('admin.recursos-humanos.evaluaciones-desempeño.objetivos-papelera');
    }

    public function objetivosExportar()
    {
        return view('admin.recursos-humanos.evaluaciones-desempeño.objetivos-exportar');
    }
}
