<?php

namespace App\Providers;

use App\Events\AccionCorrectivaEvent;
use App\Events\AlcancesEvent;
use App\Events\AuditoriaAnualEvent;
use App\Events\CatalogueCertificatesEvent;
use App\Events\ContratoEvent;
use App\Events\CoursesEvent;
use App\Events\DenunciasEvent;
use App\Events\DocumentoEvent;
use App\Events\EntendimientoOrganizacionEvent;
use App\Events\EvaluacionEvent;
use App\Events\IncidentesDeSeguridadEvent;
use App\Events\MatrizRequisitosEvent;
use App\Events\MejorasEvent;
use App\Events\MinutasEvent;
use App\Events\PermisoEvent;
use App\Events\PlanImplementacionEvent;
use App\Events\PoliticasSgiEvent;
use App\Events\PuestosEvent;
use App\Events\QuejasEvent;
use App\Events\RecursosEvent;
use App\Events\RegistroMejoraEvent;
use App\Events\RequisicionesEvent;
use App\Events\RiesgosEvent;
use App\Events\SolicitudDayofEvent;
use App\Events\SolicitudPermisoEvent;
use App\Events\SolicitudVacacionesEvent;
use App\Events\SugerenciasEvent;
use App\Events\TaskRecursosEvent;
use App\Events\TimesheetEvent;
use App\Events\TimesheetProyectoEvent;
use App\Listeners\AccionCorrectivaListener;
use App\Listeners\AlcancesListener;
use App\Listeners\AuditoriaAnualListener;
use App\Listeners\BroadcastUserLoginNotification;
use App\Listeners\CatalogueCertificateListener;
use App\Listeners\ContratosListener;
use App\Listeners\CoursesListener;
use App\Listeners\DenunciasListener;
use App\Listeners\DocumentoListener;
use App\Listeners\EntendimientoOrganizacionListener;
use App\Listeners\EvaluacionListener;
use App\Listeners\IncidentesDeSeguridadListener;
use App\Listeners\MatrizRequisitosListener;
use App\Listeners\MejorasListener;
use App\Listeners\MinutasListener;
use App\Listeners\PermisoListener;
use App\Listeners\PlanImplementacionListener;
use App\Listeners\PoliticasSgiListener;
use App\Listeners\PuestosListener;
use App\Listeners\QuejasListener;
use App\Listeners\RecursosListener;
use App\Listeners\RegistroMejoraListener;
use App\Listeners\RequisicionesListener;
use App\Listeners\RiesgosListener;
use App\Listeners\SolicitudDayofListener;
use App\Listeners\SolicitudPermisoListener;
use App\Listeners\SolicitudVacacionesListener;
use App\Listeners\SugerenciasListener;
use App\Listeners\TaskRecursosListener;
use App\Listeners\TimesheetListener;
use App\Listeners\TimesheetProyectoListener;
use App\Models\AccionCorrectiva;
use App\Models\Activo;
use App\Models\activoConfidencialidad;
use App\Models\AlcanceSgsi;
use App\Models\Area;
use App\Models\AuditoriaAnual;
use App\Models\AuditoriaInterna;
use App\Models\Calendario;
use App\Models\CalendarioOficial;
use App\Models\CategoriaCapacitacion;
use App\Models\ComunicacionSgi;
use App\Models\ContractManager\CentroCosto;
use App\Models\ContractManager\Comprador;
use App\Models\ContractManager\Contrato;
use App\Models\ContractManager\Moneda;
use App\Models\ContractManager\Producto;
use App\Models\ContractManager\ProveedorIndistinto;
use App\Models\ContractManager\ProveedorOC;
use App\Models\ContractManager\Requsicion;
use App\Models\ContractManager\Sucursal;
use App\Models\DeclaracionAplicabilidad;
use App\Models\Denuncias;
use App\Models\Documento;
use App\Models\EntendimientoOrganizacion;
use App\Models\EnvioDocumentosAjustes;
use App\Models\Escuela\Category;
use App\Models\Escuela\Course;
use App\Models\Escuela\Evaluation;
use App\Models\Escuela\Lesson;
use App\Models\Escuela\Level;
use App\Models\Escuela\Section;
use App\Models\EvaluacionDesempeno;
use App\Models\EvidenciasDocumentosEmpleados;
use App\Models\ExperienciaEmpleados;
use App\Models\IncidentesDayoff;
use App\Models\IncidentesDeSeguridad;
use App\Models\IncidentesSeguridad;
use App\Models\IncidentesVacaciones;
use App\Models\ListaDistribucion;
use App\Models\ListaInformativa;
use App\Models\Macroproceso;
use App\Models\Marca;
use App\Models\MatrizRequisitoLegale;
use App\Models\MatrizRiesgo;
use App\Models\MatrizRiesgosSistemaGestion;
use App\Models\Mejoras;
use App\Models\Minutasaltadireccion;
use App\Models\Modelo;
use App\Models\Organizacion;
use App\Models\ParticipantesListaDistribucion;
use App\Models\ParticipantesListaInformativa;
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
use App\Models\RH\CatalogoRangosObjetivos;
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
use App\Models\TBCatalogueTrainingModel;
use App\Models\Timesheet;
use App\Models\TimesheetCliente;
use App\Models\TimesheetProyecto;
use App\Models\TimesheetProyectoArea;
use App\Models\TimesheetProyectoEmpleado;
use App\Models\TimesheetTarea;
use App\Models\Tipoactivo;
use App\Models\User;
use App\Models\UsuariosListaInformativa;
use App\Models\VersionesIso;
use App\Models\Vulnerabilidad;
use App\Observers\AccionCorrectivaObserver;
use App\Observers\ActivoConfidencialObserver;
use App\Observers\ActivosObserver;
use App\Observers\AlcancesObserver;
use App\Observers\AreasObserver;
use App\Observers\AuditoriaAnualObserver;
use App\Observers\AuditoriaInternaObserver;
use App\Observers\CalendarioObserver;
use App\Observers\CatalogoRangosObjetivosObserver;
use App\Observers\CategoriaCapacitacionObserver;
use App\Observers\CategoryObserver;
use App\Observers\CentroCostoObserver;
use App\Observers\CertificatesObserver;
use App\Observers\CompetenciaObserver;
use App\Observers\CompradorObserver;
use App\Observers\ComunicadoSgiObserver;
use App\Observers\ContratoObserver;
use App\Observers\CourseObserver;
use App\Observers\DeclaracionAplicabilidadObserver;
use App\Observers\DenunciasObserver;
use App\Observers\DocumentoObserver;
use App\Observers\EntendimientoOrganizacionObserver;
use App\Observers\EnvioDocumentosAjustesObserver;
use App\Observers\EvaluacionesDesempenoObserver;
use App\Observers\EvaluacionObserver;
use App\Observers\EvaluationObserver;
use App\Observers\EvidenciasDocumentosEmpleadosObserver;
use App\Observers\ExperienciaEmpleadosObserver;
use App\Observers\GruposEvaluadoObserver;
use App\Observers\IncidentesDayoffObserver;
use App\Observers\IncidentesDeSeguridadObserver;
use App\Observers\IncidentesSeguridadObserver;
use App\Observers\IncidentesVacacionesObserver;
use App\Observers\KatbolProveedorIndistintoObserver;
use App\Observers\LessonObserver;
use App\Observers\LevelObserver;
use App\Observers\ListaDistribucionObserver;
use App\Observers\ListaInformativaObserver;
use App\Observers\MacroprocesoObserver;
use App\Observers\MarcasObserver;
use App\Observers\MastrizRequisitosObserver;
use App\Observers\MatrizRiesgoObserver;
use App\Observers\MatrizRiesgosSistemaGestionObserver;
use App\Observers\MejorasObserver;
use App\Observers\MetricasObjetivoObserver;
use App\Observers\MinutasAltaDireccionObserver;
use App\Observers\ModelosObserver;
use App\Observers\MonedaObserver;
use App\Observers\ObjetivoEmpleadoObserver;
use App\Observers\OrganizacionObserver;
use App\Observers\ParticipantesListaDistribucionObserver;
use App\Observers\ParticipantesListaInformativaObserver;
use App\Observers\PerfilEmpleadoObserver;
use App\Observers\PermisosGoceSueldoObserver;
use App\Observers\PlanBaseActividadesObserver;
use App\Observers\PlanImplementacionObserver;
use App\Observers\PoliticaSgsiObserver;
use App\Observers\ProcesosObserver;
use App\Observers\ProductoObserver;
use App\Observers\ProveedorOCObserver;
use App\Observers\PuestosObserver;
use App\Observers\QuejasClienteObserver;
use App\Observers\QuejasObserver;
use App\Observers\RecursoObserver;
use App\Observers\RecursosObserver;
use App\Observers\RegistroMejoraObserver;
use App\Observers\RequisicionesObserver;
use App\Observers\RevisionDocumentoObserver;
use App\Observers\RiesgoIdentificadoObserver;
use App\Observers\RolesObserver;
use App\Observers\SectionObserver;
use App\Observers\SedesObserver;
use App\Observers\SolicitudDayOffObserver;
use App\Observers\SolicitudPermisoGoceSueldoObserver;
use App\Observers\SolicitudVacacionesObserver;
use App\Observers\SubCategoriaActivoObserver;
use App\Observers\SucursalObserver;
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
use App\Observers\UsuariosListaInformativaObserver;
use App\Observers\VersionesIsoObserver;
use App\Observers\VulnerabilidadObserver;
use Illuminate\Auth\Events\Login;
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
        Login::class => [
            BroadcastUserLoginNotification::class,
        ],
        IncidentesDeSeguridadEvent::class => [
            IncidentesDeSeguridadListener::class,
        ],
        RiesgosEvent::class => [
            RiesgosListener::class,
        ],
        QuejasEvent::class => [
            QuejasListener::class,
        ],
        DenunciasEvent::class => [
            DenunciasListener::class,
        ],
        MejorasEvent::class => [
            MejorasListener::class,
        ],
        SugerenciasEvent::class => [
            SugerenciasListener::class,
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
        // PoliticasSgiEvent::class => [
        //     PoliticasSgiListener::class,
        // ],
        // AlcancesEvent::class => [
        //     AlcancesListener::class,
        // ],
        MatrizRequisitosEvent::class => [
            MatrizRequisitosListener::class,
        ],
        RequisicionesEvent::class => [
            RequisicionesListener::class,
        ],
        // EntendimientoOrganizacionEvent::class => [
        //     EntendimientoOrganizacionListener::class,
        // ],
        DocumentoEvent::class => [
            DocumentoListener::class,
        ],
        TimesheetEvent::class => [
            TimesheetListener::class,
        ],
        TimesheetProyectoEvent::class => [
            TimesheetProyectoListener::class,
        ],
        // CoursesEvent::class => [
        //     CoursesListener::class,
        // ],
        SolicitudVacacionesEvent::class => [
            SolicitudVacacionesListener::class,
        ],
        SolicitudDayofEvent::class => [
            SolicitudDayofListener::class,
        ],
        SolicitudPermisoEvent::class => [
            SolicitudPermisoListener::class,
        ],
        PermisoEvent::class => [
            PermisoListener::class,
        ],
        PlanImplementacionEvent::class => [
            PlanImplementacionListener::class,
        ],
        EvaluacionEvent::class => [
            EvaluacionListener::class,
        ],
        // ContratoEvent::class => [
        //     ContratosListener::class,
        // ],
        MinutasEvent::class => [
            MinutasListener::class,
        ],
        PuestosEvent::class => [
            PuestosListener::class,
        ],
        CatalogueCertificatesEvent::class => [
            CatalogueCertificateListener::class,
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
        AlcanceSgsi::observe(AlcancesObserver::class);
        Requsicion::observe(RequisicionesObserver::class);
        CentroCosto::observe(CentroCostoObserver::class);
        Comprador::observe(CompradorObserver::class);
        MatrizRequisitoLegale::observe(MastrizRequisitosObserver::class);
        Moneda::observe(MonedaObserver::class);
        ProveedorOC::observe(ProveedorOCObserver::class);
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
        Producto::observe(ProductoObserver::class);
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
        Sucursal::observe(SucursalObserver::class);
        CatalogoRangosObjetivos::observe(CatalogoRangosObjetivosObserver::class);
        Vulnerabilidad::observe(VulnerabilidadObserver::class);
        ListaInformativa::observe(ListaInformativaObserver::class);
        ParticipantesListaInformativa::observe(ParticipantesListaInformativaObserver::class);
        UsuariosListaInformativa::observe(UsuariosListaInformativaObserver::class);
        ListaDistribucion::observe(ListaDistribucionObserver::class);
        ParticipantesListaDistribucion::observe(ParticipantesListaDistribucionObserver::class);
        Category::observe(CategoryObserver::class);
        Level::observe(LevelObserver::class);
        EvaluacionDesempeno::observe(EvaluacionesDesempenoObserver::class);
        TBCatalogueTrainingModel::observe(CertificatesObserver::class);
        Evaluation::observe(EvaluationObserver::class);
    }
}
