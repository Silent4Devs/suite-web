<?php

namespace App\Providers;

use App\Models\Area;
use App\Models\Sede;
use App\Models\User;
use App\Models\Marca;
use App\Models\Activo;
use App\Models\Modelo;
use App\Models\Puesto;
use App\Models\Quejas;
use App\Models\Mejoras;
use App\Models\Proceso;
use App\Models\Recurso;
use App\Models\Denuncias;
use App\Models\Timesheet;
use App\Models\Calendario;
use App\Models\Tipoactivo;
use App\Models\Sugerencias;
use App\Models\Organizacion;
use App\Events\RecursosEvent;
use App\Models\QuejasCliente;
use App\Models\RH\Evaluacion;
use App\Models\AuditoriaAnual;
use App\Models\Registromejora;
use App\Models\RH\Competencia;
use App\Models\TimesheetTarea;
use App\Models\RH\TipoObjetivo;
use App\Models\AccionCorrectiva;
use App\Models\TimesheetCliente;
use App\Observers\AreasObserver;
use App\Observers\SedesObserver;
use App\Observers\UsersObserver;
use App\Events\TaskRecursosEvent;
use App\Models\TimesheetProyecto;
use App\Observers\MarcasObserver;
use App\Observers\QuejasObserver;
use App\Models\PlanImplementacion;
use App\Models\RH\TipoCompetencia;
use App\Models\RiesgoIdentificado;
use App\Models\SubcategoriaActivo;
use App\Observers\ActivosObserver;
use App\Observers\MejorasObserver;
use App\Observers\ModelosObserver;
use App\Observers\PuestosObserver;
use App\Observers\RecursoObserver;
use App\Events\AuditoriaAnualEvent;
use App\Events\RegistroMejoraEvent;
use App\Listeners\RecursosListener;
use App\Models\IncidentesSeguridad;
use App\Models\RH\MetricasObjetivo;
use App\Observers\ProcesosObserver;
use App\Observers\RecursosObserver;
use App\Models\ExperienciaEmpleados;
use App\Observers\DenunciasObserver;
use App\Observers\TimesheetObserver;
use App\Events\AccionCorrectivaEvent;
use App\Models\IncidentesDeSeguridad;
use App\Observers\CalendarioObserver;
use App\Observers\EvaluacionObserver;
use App\Observers\TipoActivoObserver;
use Illuminate\Support\Facades\Event;
use App\Models\activoConfidencialidad;
use App\Observers\CompetenciaObserver;
use App\Observers\SugerenciasObserver;
use Illuminate\Auth\Events\Registered;
use App\Listeners\TaskRecursosListener;
use App\Observers\OrganizacionObserver;
use App\Observers\tipoObjetivoObserver;
use App\Models\DeclaracionAplicabilidad;
use App\Observers\QuejasClienteObserver;
use App\Listeners\AuditoriaAnualListener;
use App\Listeners\RegistroMejoraListener;
use App\Observers\AuditoriaAnualObserver;
use App\Observers\RegistroMejoraObserver;
use App\Observers\TimeSheetTareaObserver;
use App\Events\IncidentesDeSeguridadEvent;
use App\Observers\TipoCompetenciaObserver;
use App\Listeners\AccionCorrectivaListener;
use App\Models\MatrizRiesgosSistemaGestion;
use App\Observers\AccionCorrectivaObserver;
use App\Observers\MetricasObjetivoObserver;
use App\Observers\TimeSheetClienteObserver;
use App\Observers\TimeSheetProyectoObserver;
use App\Observers\ActivoConfidencialObserver;
use App\Observers\PlanImplementacionObserver;
use App\Observers\RiesgoIdentificadoObserver;
use App\Observers\SubCategoriaActivoObserver;
use App\Observers\IncidentesSeguridadObserver;
use App\Observers\ExperienciaEmpleadosObserver;
use App\Listeners\IncidentesDeSeguridadListener;
use App\Observers\IncidentesDeSeguridadObserver;
use App\Observers\DeclaracionAplicabilidadObserver;
use App\Observers\MatrizRiesgosSistemaGestionObserver;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

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
        Evaluacion::observe(EvaluacionObserver::class);
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
    }
}
