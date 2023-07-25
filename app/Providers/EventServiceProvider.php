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
use App\Models\Calendario;
use App\Models\DeclaracionAplicabilidad;
use App\Models\ExperienciaEmpleados;
use App\Models\IncidentesDeSeguridad;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Organizacion;
use App\Models\PlanImplementacion;
use App\Models\Proceso;
use App\Models\Puesto;
use App\Models\Recurso;
use App\Models\Registromejora;
use App\Models\RH\Competencia;
use App\Models\RH\Evaluacion;
use App\Models\RH\MetricasObjetivo;
use App\Models\RH\TipoCompetencia;
use App\Models\RH\TipoObjetivo;
use App\Models\Sede;
use App\Models\SubcategoriaActivo;
use App\Models\Timesheet;
use App\Models\TimesheetCliente;
use App\Models\TimesheetProyecto;
use App\Models\TimesheetTarea;
use App\Models\Tipoactivo;
use App\Models\User;
use App\Observers\AccionCorrectivaObserver;
use App\Observers\ActivoConfidencialObserver;
use App\Observers\ActivosObserver;
use App\Observers\AreasObserver;
use App\Observers\AuditoriaAnualObserver;
use App\Observers\CalendarioObserver;
use App\Observers\CompetenciaObserver;
use App\Observers\DeclaracionAplicabilidadObserver;
use App\Observers\EvaluacionObserver;
use App\Observers\ExperienciaEmpleadosObserver;
use App\Observers\IncidentesDeSeguridadObserver;
use App\Observers\MarcasObserver;
use App\Observers\MetricasObjetivoObserver;
use App\Observers\ModelosObserver;
use App\Observers\OrganizacionObserver;
use App\Observers\PlanImplementacionObserver;
use App\Observers\ProcesosObserver;
use App\Observers\PuestosObserver;
use App\Observers\RecursoObserver;
use App\Observers\RecursosObserver;
use App\Observers\RegistroMejoraObserver;
use App\Observers\SedesObserver;
use App\Observers\SubCategoriaActivoObserver;
use App\Observers\TimeSheetClienteObserver;
use App\Observers\TimesheetObserver;
use App\Observers\TimeSheetProyectoObserver;
use App\Observers\TimeSheetTareaObserver;
use App\Observers\TipoActivoObserver;
use App\Observers\TipoCompetenciaObserver;
use App\Observers\tipoObjetivoObserver;
use App\Observers\UsersObserver;
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
        Evaluacion::observe(EvaluacionObserver::class);
        MetricasObjetivo::observe(MetricasObjetivoObserver::class);
        TipoCompetencia::observe(TipoCompetenciaObserver::class);
        Puesto::observe(PuestosObserver::class);
        activoConfidencialidad::observe(ActivoConfidencialObserver::class);
        Timesheet::observe(TimesheetObserver::class);
    }
}
