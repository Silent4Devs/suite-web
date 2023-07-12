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
use App\Models\AuditoriaAnual;
use App\Models\IncidentesDeSeguridad;
use App\Models\Organizacion;
use App\Models\PlanImplementacion;
use App\Models\Recurso;
use App\Models\Registromejora;
use App\Models\Sede;
use App\Models\User;
use App\Observers\AccionCorrectivaObserver;
use App\Observers\AuditoriaAnualObserver;
use App\Observers\IncidentesDeSeguridadObserver;
use App\Observers\OrganizacionObserver;
use App\Observers\PlanImplementacionObserver;
use App\Observers\RecursosObserver;
use App\Observers\RegistroMejoraObserver;
use App\Observers\SedesObserver;
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
        #Redis
        PlanImplementacion::observe(PlanImplementacionObserver::class);
        Organizacion::observe(OrganizacionObserver::class);
        Sede::observe(SedesObserver::class);
        User::observe(UsersObserver::class);
    }
}
