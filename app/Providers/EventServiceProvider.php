<?php

namespace App\Providers;

use App\Events\AccionCorrectivaEvent;
use App\Events\AuditoriaAnualEvent;
use App\Events\IncidentesDeSeguridadEvent;
use App\Events\RecursosEvent;
use App\Events\RegistroMejoraEvent;
use App\Events\TaskRecursosEvent;
use App\Listeners\AccionCorrectivaListener;
use App\Listeners\AuditoriaAnualListener;
use App\Listeners\IncidentesDeSeguridadListener;
use App\Listeners\RecursosListener;
use App\Listeners\RegistroMejoraListener;
use App\Listeners\TaskRecursosListener;
use App\Models\AccionCorrectiva;
use App\Models\Activo;
use App\Models\activoConfidencialidad;
use App\Models\Area;
use App\Models\AuditoriaAnual;
use App\Models\AuditoriaInterna;
use App\Models\Calendario;
use App\Models\CalendarioOficial;
use App\Models\CategoriaCapacitacion;
use App\Models\ComunicacionSgi;
use App\Models\ContractManager\Contrato;
use App\Models\ContractManager\ProveedorIndistinto;
use App\Models\DeclaracionAplicabilidad;
use App\Models\Denuncias;
use App\Models\Documento;
use App\Models\EntendimientoOrganizacion;
use App\Models\EnvioDocumentosAjustes;
use App\Models\Escuela\Course;
use App\Models\Escuela\Lesson;
use App\Models\Escuela\Section;
use App\Models\EvidenciasDocumentosEmpleados;
use App\Models\ExperienciaEmpleados;
use App\Models\IncidentesDayoff;
use App\Models\IncidentesDeSeguridad;
use App\Models\IncidentesSeguridad;
use App\Models\IncidentesVacaciones;
use App\Models\Macroproceso;
use App\Models\Marca;
use App\Models\MatrizRiesgo;
use App\Models\MatrizRiesgosSistemaGestion;
use App\Models\Mejoras;
use App\Models\Minutasaltadireccion;
use App\Models\Modelo;
use App\Models\Organizacion;
use App\Models\PerfilEmpleado;
use App\Models\PermisosGoceSueldo;
use App\Models\PlanBaseActividade;
use App\Models\PlanImplementacion;
use App\Models\PoliticaSgsi;
use App\Models\Proceso;
use App\Models\Puesto;
use App\Models\Quejas;
use App\Models\QuejasCliente;
use App\Models\Recurso;
use App\Models\Registromejora;
use App\Models\RevisionDocumento;
use App\Models\RH\Competencia;
use App\Models\RH\Evaluacion;
use App\Models\RH\GruposEvaluado;
use App\Models\RH\MetricasObjetivo;
use App\Models\RH\ObjetivoEmpleado;
use App\Models\RH\TipoCompetencia;
use App\Models\RH\TipoContratoEmpleado;
use App\Models\RH\TipoObjetivo;
use App\Models\RiesgoIdentificado;
use App\Models\Role;
use App\Models\Sede;
use App\Models\SolicitudDayOff;
use App\Models\SolicitudPermisoGoceSueldo;
use App\Models\SolicitudVacaciones;
use App\Models\SubcategoriaActivo;
use App\Models\Sugerencias;
use App\Models\Timesheet;
use App\Models\TimesheetCliente;
use App\Models\TimesheetProyecto;
use App\Models\TimesheetProyectoArea;
use App\Models\TimesheetProyectoEmpleado;
use App\Models\TimesheetTarea;
use App\Models\Tipoactivo;
use App\Models\User;
use App\Models\VersionesIso;
use App\Observers\AccionCorrectivaObserver;
use App\Observers\ActivoConfidencialObserver;
use App\Observers\ActivosObserver;
use App\Observers\AreasObserver;
use App\Observers\AuditoriaAnualObserver;
use App\Observers\AuditoriaInternaObserver;
use App\Observers\CalendarioObserver;
use App\Observers\CategoriaCapacitacionObserver;
use App\Observers\CompetenciaObserver;
use App\Observers\ComunicadoSgiObserver;
use App\Observers\ContratoObserver;
use App\Observers\CourseObserver;
use App\Observers\DeclaracionAplicabilidadObserver;
use App\Observers\DenunciasObserver;
use App\Observers\DocumentoObserver;
use App\Observers\EntendimientoOrganizacionObserver;
use App\Observers\EnvioDocumentosAjustesObserver;
use App\Observers\EvaluacionObserver;
use App\Observers\EvidenciasDocumentosEmpleadosObserver;
use App\Observers\ExperienciaEmpleadosObserver;
use App\Observers\GruposEvaluadoObserver;
use App\Observers\IncidentesDayoffObserver;
use App\Observers\IncidentesDeSeguridadObserver;
use App\Observers\IncidentesSeguridadObserver;
use App\Observers\IncidentesVacacionesObserver;
use App\Observers\KatbolProveedorIndistintoObserver;
use App\Observers\LessonObserver;
use App\Observers\MacroprocesoObserver;
use App\Observers\MarcasObserver;
use App\Observers\MatrizRiesgoObserver;
use App\Observers\MatrizRiesgosSistemaGestionObserver;
use App\Observers\MejorasObserver;
use App\Observers\MetricasObjetivoObserver;
use App\Observers\MinutasAltaDireccionObserver;
use App\Observers\ModelosObserver;
use App\Observers\ObjetivoEmpleadoObserver;
use App\Observers\OrganizacionObserver;
use App\Observers\PerfilEmpleadoObserver;
use App\Observers\PermisosGoceSueldoObserver;
use App\Observers\PlanBaseActividadesObserver;
use App\Observers\PlanImplementacionObserver;
use App\Observers\PoliticaSgsiObserver;
use App\Observers\ProcesosObserver;
use App\Observers\PuestosObserver;
use App\Observers\QuejasClienteObserver;
use App\Observers\QuejasObserver;
use App\Observers\RecursoObserver;
use App\Observers\RecursosObserver;
use App\Observers\RegistroMejoraObserver;
use App\Observers\RevisionDocumentoObserver;
use App\Observers\RiesgoIdentificadoObserver;
use App\Observers\RolesObserver;
use App\Observers\SectionObserver;
use App\Observers\SedesObserver;
use App\Observers\SolicitudDayOffObserver;
use App\Observers\SolicitudPermisoGoceSueldoObserver;
use App\Observers\SolicitudVacacionesObserver;
use App\Observers\SubCategoriaActivoObserver;
use App\Observers\SugerenciasObserver;
use App\Observers\TimeSheetClienteObserver;
use App\Observers\TimesheetObserver;
use App\Observers\TimesheetProyectoAreaObserver;
use App\Observers\TimesheetProyectoEmpleadoObserver;
use App\Observers\TimeSheetProyectoObserver;
use App\Observers\TimeSheetTareaObserver;
use App\Observers\TipoActivoObserver;
use App\Observers\TipoCompetenciaObserver;
use App\Observers\TipoContratoEmpleadoObserver;
use App\Observers\tipoObjetivoObserver;
use App\Observers\UsersObserver;
use App\Observers\VersionesIsoObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        IncidentesDeSeguridadEvent::class => [
            IncidentesDeSeguridadListener::class,
        ],
        AuditoriaAnualEvent::class => [
            AuditoriaAnualListener::class,
        ],
        AccionCorrectivaEvent::class => [
            AccionCorrectivaListener::class,
        ],
        RegistroMejoraEvent::class => [
            RegistroMejoraListener::class,
        ],
        RecursosEvent::class => [
            RecursosListener::class,
        ],
        TaskRecursosEvent::class => [
            TaskRecursosListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        IncidentesDeSeguridad::observe(IncidentesDeSeguridadObserver::class);
        AuditoriaAnual::observe(AuditoriaAnualObserver::class);
        AccionCorrectiva::observe(AccionCorrectivaObserver::class);
        Registromejora::observe(RegistroMejoraObserver::class);
        Recurso::observe(RecursosObserver::class);
        //Redis
        PlanImplementacion::observe(PlanImplementacionObserver::class);
        Organizacion::observe(OrganizacionObserver::class);
        Sede::observe(SedesObserver::class);
        User::observe(UsersObserver::class);
        Calendario::observe(CalendarioObserver::class);
        AuditoriaAnual::observe(AuditoriaAnualObserver::class);
        Area::observe(AreasObserver::class);
        Proceso::observe(ProcesosObserver::class);
        Activo::observe(ActivosObserver::class);
        Recurso::observe(RecursoObserver::class);
        TimesheetProyecto::observe(TimeSheetProyectoObserver::class);
        TimesheetTarea::observe(TimeSheetTareaObserver::class);
        TimesheetCliente::observe(TimeSheetClienteObserver::class);
        ExperienciaEmpleados::observe(ExperienciaEmpleadosObserver::class);
        DeclaracionAplicabilidad::observe(DeclaracionAplicabilidadObserver::class);
        Tipoactivo::observe(TipoActivoObserver::class);
        Marca::observe(MarcasObserver::class);
        Modelo::observe(ModelosObserver::class);
        Evaluacion::observe(EvaluacionObserver::class);
        Competencia::observe(CompetenciaObserver::class);
        SubcategoriaActivo::observe(SubCategoriaActivoObserver::class);
        TipoObjetivo::observe(tipoObjetivoObserver::class);
        MetricasObjetivo::observe(MetricasObjetivoObserver::class);
        TipoCompetencia::observe(TipoCompetenciaObserver::class);
        Puesto::observe(PuestosObserver::class);
        activoConfidencialidad::observe(ActivoConfidencialObserver::class);
        Timesheet::observe(TimesheetObserver::class);
        Quejas::observe(QuejasObserver::class);
        Denuncias::observe(DenunciasObserver::class);
        Mejoras::observe(MejorasObserver::class);
        Sugerencias::observe(SugerenciasObserver::class);
        IncidentesSeguridad::observe(IncidentesSeguridadObserver::class);
        RiesgoIdentificado::observe(RiesgoIdentificadoObserver::class);
        QuejasCliente::observe(QuejasClienteObserver::class);
        MatrizRiesgosSistemaGestion::observe(MatrizRiesgosSistemaGestionObserver::class);
        PoliticaSgsi::observe(PoliticaSgsiObserver::class);
        MatrizRiesgo::observe(MatrizRiesgoObserver::class);
        TimesheetProyectoEmpleado::observe(TimesheetProyectoEmpleadoObserver::class);
        Lesson::observe(LessonObserver::class);
        Section::observe(SectionObserver::class);
        VersionesIso::observe(VersionesIsoObserver::class);
        CalendarioOficial::observe(CalendarioObserver::class);
        Documento::observe(DocumentoObserver::class);
        AuditoriaInterna::observe(AuditoriaInternaObserver::class);
        RevisionDocumento::observe(RevisionDocumentoObserver::class);
        EvidenciasDocumentosEmpleados::observe(EvidenciasDocumentosEmpleadosObserver::class);
        TimesheetProyectoArea::observe(TimesheetProyectoAreaObserver::class);
        ComunicacionSgi::observe(ComunicadoSgiObserver::class);
        Course::observe(CourseObserver::class);
        Contrato::observe(ContratoObserver::class);
        PerfilEmpleado::observe(PerfilEmpleadoObserver::class);
        IncidentesVacaciones::observe(IncidentesVacacionesObserver::class);
        IncidentesDayoff::observe(IncidentesDayoffObserver::class);
        SolicitudDayOff::observe(SolicitudDayOffObserver::class);
        SolicitudVacaciones::observe(SolicitudVacacionesObserver::class);
        SolicitudPermisoGoceSueldo::observe(SolicitudPermisoGoceSueldoObserver::class);
        PermisosGoceSueldo::observe(PermisosGoceSueldoObserver::class);
        Minutasaltadireccion::observe(MinutasAltaDireccionObserver::class);
        Role::observe(RolesObserver::class);
        ObjetivoEmpleado::observe(ObjetivoEmpleadoObserver::class);
        GruposEvaluado::observe(GruposEvaluadoObserver::class);
        CategoriaCapacitacion::observe(CategoriaCapacitacionObserver::class);
        TipoContratoEmpleado::observe(TipoContratoEmpleadoObserver::class);
        EntendimientoOrganizacion::observe(EntendimientoOrganizacionObserver::class);
        EnvioDocumentosAjustes::observe(EnvioDocumentosAjustesObserver::class);
        PlanBaseActividade::observe(PlanBaseActividadesObserver::class);
        Macroproceso::observe(MacroprocesoObserver::class);
        ProveedorIndistinto::observe(KatbolProveedorIndistintoObserver::class);
    }
}
