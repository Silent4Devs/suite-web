<?php

namespace App\Http\Controllers\admin;

use App\Events\DenunciasEvent;
use App\Events\IncidentesDeSeguridadEvent;
use App\Events\MejorasEvent;
use App\Events\QuejasEvent;
use App\Events\RiesgosEvent;
use App\Events\SugerenciasEvent;
use App\Http\Controllers\Controller;
use App\Mail\AceptacionAccionCorrectivaEmail;
use App\Mail\AtencionQuejaAtendidaEmail;
use App\Mail\CierreQuejaAceptadaEmail;
use App\Mail\NotificacionResponsableQuejaEmail;
use App\Mail\ResolucionQuejaRechazadaEmail;
use App\Mail\SeguimientoQuejaClienteEmail;
use App\Mail\SolicitarCierreQuejaEmail;
use App\Mail\SolicitudAprobacion;
use App\Models\AccionCorrectiva;
use App\Models\Activo;
use App\Models\AnalisisQuejasClientes;
use App\Models\AnalisisSeguridad;
use App\Models\AprobadorSeleccionado;
use App\Models\Area;
use App\Models\CategoriaIncidente;
use App\Models\Denuncias;
use App\Models\Empleado;
use App\Models\EvidenciaQuejasClientes;
use App\Models\EvidenciasQuejasClientesCerrado;
use App\Models\EvidenciasSeguridad;
use App\Models\FirmaCentroAtencion;
use App\Models\FirmaModule;
use App\Models\IncidentesSeguridad;
use App\Models\Mejoras;
use App\Models\Organizacion;
use App\Models\Proceso;
use App\Models\Quejas;
use App\Models\QuejasCliente;
use App\Models\RiesgoIdentificado;
use App\Models\Sede;
use App\Models\SubcategoriaIncidente;
use App\Models\Sugerencias;
use App\Models\TimesheetCliente;
use App\Models\TimesheetProyecto;
use App\Models\User;
use App\Traits\ObtenerOrganizacion;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail; //mejora apunta a este modelo

class DeskController extends Controller
{
    use ObtenerOrganizacion;

    public function index()
    {
        abort_if(Gate::denies('centro_de_atencion_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $incidentesSeguridad = IncidentesSeguridad::getAll();
        $incidentes_seguridad = $incidentesSeguridad->where('archivado', IncidentesSeguridad::NO_ARCHIVADO);
        $riesgos_identificados = RiesgoIdentificado::getAll();
        $quejas = Quejas::getAll();
        $denuncias = Denuncias::getAll();
        $mejoras = Mejoras::getAll();
        $sugerencias = Sugerencias::getAll();
        $quejasClientes = QuejasCliente::getAll();

        $total_seguridad = $incidentesSeguridad->count();
        $nuevos_seguridad = $incidentesSeguridad->where('estatus', 'Sin atender')->count();
        $en_curso_seguridad = $incidentesSeguridad->where('estatus', 'En curso')->count();
        $en_espera_seguridad = $incidentesSeguridad->where('estatus', 'En espera')->count();
        $cerrados_seguridad = $incidentesSeguridad->where('estatus', 'Cerrado')->count();
        $cancelados_seguridad = $incidentesSeguridad->where('estatus', 'No procedente')->count();

        $total_riesgos = $riesgos_identificados->count();
        $nuevos_riesgos = $riesgos_identificados->where('estatus', 'nuevo')->count();
        $en_curso_riesgos = $riesgos_identificados->where('estatus', 'en curso')->count();
        $en_espera_riesgos = $riesgos_identificados->where('estatus', 'en espera')->count();
        $cerrados_riesgos = $riesgos_identificados->where('estatus', 'cerrado')->count();
        $cancelados_riesgos = $riesgos_identificados->where('estatus', 'cancelado')->count();

        $total_quejas = $quejas->count();
        $nuevos_quejas = $quejas->where('estatus', 'nuevo')->count();
        $en_curso_quejas = $quejas->where('estatus', 'en curso')->count();
        $en_espera_quejas = $quejas->where('estatus', 'en espera')->count();
        $cerrados_quejas = $quejas->where('estatus', 'cerrado')->count();
        $cancelados_quejas = $quejas->where('estatus', 'cancelado')->count();

        $total_quejasClientes = $quejasClientes->count();
        $nuevos_quejasClientes = $quejasClientes->where('estatus', 'Sin atender')->count();
        $en_curso_quejasClientes = $quejasClientes->where('estatus', 'En curso')->count();
        $en_espera_quejasClientes = $quejasClientes->where('estatus', 'En espera')->count();
        $cerrados_quejasClientes = $quejasClientes->where('estatus', 'Cerrado')->count();
        $cancelados_quejasClientes = $quejasClientes->where('estatus', 'No procedente')->count();

        $total_denuncias = $denuncias->count();
        $nuevos_denuncias = $denuncias->where('estatus', 'nuevo')->count();
        $en_curso_denuncias = $denuncias->where('estatus', 'en curso')->count();
        $en_espera_denuncias = $denuncias->where('estatus', 'en espera')->count();
        $cerrados_denuncias = $denuncias->where('estatus', 'cerrado')->count();
        $cancelados_denuncias = $denuncias->where('estatus', 'cancelado')->count();

        $total_mejoras = $mejoras->count();
        $nuevos_mejoras = $mejoras->where('estatus', 'nuevo')->count();
        $en_curso_mejoras = $mejoras->where('estatus', 'en curso')->count();
        $en_espera_mejoras = $mejoras->where('estatus', 'en espera')->count();
        $cerrados_mejoras = $mejoras->where('estatus', 'cerrado')->count();
        $cancelados_mejoras = $mejoras->where('estatus', 'cancelado')->count();

        $total_sugerencias = $sugerencias->count();
        $nuevos_sugerencias = $sugerencias->where('estatus', 'nuevo')->count();
        $en_curso_sugerencias = $sugerencias->where('estatus', 'en curso')->count();
        $en_espera_sugerencias = $sugerencias->where('estatus', 'en espera')->count();
        $cerrados_sugerencias = $sugerencias->where('estatus', 'cerrado')->count();
        $cancelados_sugerencias = $sugerencias->where('estatus', 'cancelado')->count();

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.desk.index', compact(
            'logo_actual',
            'empresa_actual',
            'incidentes_seguridad',
            'riesgos_identificados',
            'quejas',
            'denuncias',
            'mejoras',
            'sugerencias',
            'total_seguridad',
            'nuevos_seguridad',
            'en_curso_seguridad',
            'en_espera_seguridad',
            'cerrados_seguridad',
            'cancelados_seguridad',
            'total_riesgos',
            'nuevos_riesgos',
            'en_curso_riesgos',
            'en_espera_riesgos',
            'cerrados_riesgos',
            'cancelados_riesgos',
            'total_quejas',
            'nuevos_quejas',
            'en_curso_quejas',
            'en_espera_quejas',
            'cerrados_quejas',
            'cancelados_quejas',
            'total_quejasClientes',
            'nuevos_quejasClientes',
            'en_curso_quejasClientes',
            'en_espera_quejasClientes',
            'cerrados_quejasClientes',
            'cancelados_quejasClientes',
            'total_denuncias',
            'nuevos_denuncias',
            'en_curso_denuncias',
            'en_espera_denuncias',
            'cerrados_denuncias',
            'cancelados_denuncias',
            'total_mejoras',
            'nuevos_mejoras',
            'en_curso_mejoras',
            'en_espera_mejoras',
            'cerrados_mejoras',
            'cancelados_mejoras',
            'total_sugerencias',
            'nuevos_sugerencias',
            'en_curso_sugerencias',
            'en_espera_sugerencias',
            'cerrados_sugerencias',
            'cancelados_sugerencias',
        ));
    }
}
