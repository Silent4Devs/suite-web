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
        // Automatically register events and observers
        $models = [
            \App\Models\IncidentesDeSeguridad::class => \App\Observers\IncidentesDeSeguridadObserver::class,
            \App\Models\AuditoriaAnual::class => \App\Observers\AuditoriaAnualObserver::class,
            \App\Models\AccionCorrectiva::class => \App\Observers\AccionCorrectivaObserver::class,
            \App\Models\Registromejora::class => \App\Observers\RegistroMejoraObserver::class,
            \App\Models\Recurso::class => \App\Observers\RecursosObserver::class,
            \App\Models\PlanImplementacion::class => \App\Observers\PlanImplementacionObserver::class,
            \App\Models\Organizacion::class => \App\Observers\OrganizacionObserver::class,
            \App\Models\Sede::class => \App\Observers\SedesObserver::class,
            \App\Models\User::class => \App\Observers\UsersObserver::class,
            \App\Models\Calendario::class => \App\Observers\CalendarioObserver::class,
            \App\Models\AuditoriaAnual::class => \App\Observers\AuditoriaAnualObserver::class,
            \App\Models\Area::class => \App\Observers\AreasObserver::class,
            \App\Models\Proceso::class => \App\Observers\ProcesosObserver::class,
            \App\Models\Activo::class => \App\Observers\ActivosObserver::class,
            \App\Models\Recurso::class => \App\Observers\RecursoObserver::class,
            \App\Models\TimesheetProyecto::class => \App\Observers\TimeSheetProyectoObserver::class,
            \App\Models\TimesheetTarea::class => \App\Observers\TimeSheetTareaObserver::class,
            \App\Models\TimesheetCliente::class => \App\Observers\TimeSheetClienteObserver::class,
            \App\Models\ExperienciaEmpleados::class => \App\Observers\ExperienciaEmpleadosObserver::class,
            \App\Models\DeclaracionAplicabilidad::class => \App\Observers\DeclaracionAplicabilidadObserver::class,
            \App\Models\Tipoactivo::class => \App\Observers\TipoActivoObserver::class,
            \App\Models\Marca::class => \App\Observers\MarcasObserver::class,
            \App\Models\Modelo::class => \App\Observers\ModelosObserver::class,
            \App\Models\Evaluacion::class => \App\Observers\EvaluacionObserver::class,
            \App\Models\Competencia::class => \App\Observers\CompetenciaObserver::class,
            \App\Models\SubcategoriaActivo::class => \App\Observers\SubCategoriaActivoObserver::class,
            \App\Models\TipoObjetivo::class => \App\Observers\tipoObjetivoObserver::class,
            \App\Models\Evaluacion::class => \App\Observers\EvaluacionObserver::class,
            \App\Models\MetricasObjetivo::class => \App\Observers\MetricasObjetivoObserver::class,
            \App\Models\TipoCompetencia::class => \App\Observers\TipoCompetenciaObserver::class,
            \App\Models\Puesto::class => \App\Observers\PuestosObserver::class,
            \App\Models\activoConfidencialidad::class => \App\Observers\ActivoConfidencialObserver::class,
            \App\Models\Timesheet::class => \App\Observers\TimesheetObserver::class,
            \App\Models\Quejas::class => \App\Observers\QuejasObserver::class,
            \App\Models\Denuncias::class => \App\Observers\DenunciasObserver::class,
            \App\Models\Mejoras::class => \App\Observers\MejorasObserver::class,
            \App\Models\Sugerencias::class => \App\Observers\SugerenciasObserver::class,
            \App\Models\IncidentesSeguridad::class => \App\Observers\IncidentesSeguridadObserver::class,
            \App\Models\RiesgoIdentificado::class => \App\Observers\RiesgoIdentificadoObserver::class,
            \App\Models\QuejasCliente::class => \App\Observers\QuejasClienteObserver::class,
            \App\Models\MatrizRiesgosSistemaGestion::class => \App\Observers\MatrizRiesgosSistemaGestionObserver::class,
            \App\Models\PoliticaSgsi::class => \App\Observers\PoliticaSgsiObserver::class,
            \App\Models\MatrizRiesgo::class => \App\Observers\MatrizRiesgoObserver::class,
            \App\Models\TimesheetProyectoEmpleado::class => \App\Observers\TimesheetProyectoEmpleadoObserver::class,
            \App\Models\Lesson::class => \App\Observers\LessonObserver::class,
            \App\Models\Section::class => \App\Observers\SectionObserver::class,
            \App\Models\VersionesIso::class => \App\Observers\VersionesIsoObserver::class,
            // Add more models and observers here
        ];

        foreach ($models as $model => $observer) {
            $model::observe($observer);
        }
    }
}
