<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditoriaAnual;
use App\Models\AuditoriaInterna;
use App\Models\Calendario;
use App\Models\CalendarioOficial;
use App\Models\ContractManager\Contrato;
use App\Models\ContractManager\EntregaMensual;
use App\Models\ContractManager\Factura;
use App\Models\Empleado;
use App\Models\Organizacion;
use App\Models\PlanBaseActividade;
use App\Models\PlanImplementacion;
use App\Models\Recurso;
use App\Models\Mejoras;
use App\Models\AccionCorrectiva;
use App\Models\AuditoriaInternasHallazgos;
use App\Models\ClasificacionesAuditorias;
use GuzzleHttp\Psr7\Request;


class DashboardAuditoriasSGIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.AuditoriasSGI.index');
    }
    public function obtenerClausulaId($incumplimiento)
    {
        // Utiliza el modelo para buscar el valor de clausula_id en función de incumplimiento_requisito
        $clausulaId = AuditoriaInternasHallazgos::where('incumplimiento_requisito', $incumplimiento)->value('clausula_id');

        // Devuelve el valor de clausula_id en formato JSON
        return response()->json(['clausula_id' => $clausulaId]);
    }

    // Otros métodos de tu controlador...
}
