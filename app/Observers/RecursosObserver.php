<?php

namespace App\Observers;

use App\Events\RecursosEvent;
use App\Http\Requests\StoreRecursoRequest;
use App\Models\Recurso;

class RecursosObserver
{
    protected $request;

    public function __construct(StoreRecursoRequest $request)
    {
        $this->request = $request;
    }
    /**
     * Handle the Recurso "created" event.
     *
     * @param  \App\Models\Recurso  $recurso
     * @return void
     */
    public function created(Recurso $recurso)
    {
        $recurso->participantes()->sync($this->request->input('participantes', []));
        event(new RecursosEvent($recurso, 'create', 'recurso', 'Curso y Capacitación'));
    }

    /**
     * Handle the Recurso "updated" event.
     *
     * @param  \App\Models\Recurso  $recurso
     * @return void
     */
    public function updated(Recurso $recurso)
    {
        $recurso->participantes()->sync($this->request->input('participantes', []));
        event(new RecursosEvent($recurso, 'update', 'recurso', 'Curso y Capacitación'));
    }

    /**
     * Handle the Recurso "deleted" event.
     *
     * @param  \App\Models\Recurso  $recurso
     * @return void
     */
    public function deleted(Recurso $recurso)
    {
        event(new RecursosEvent($recurso, 'delete', 'recurso', 'Curso y Capacitación'));
    }

    /**
     * Handle the Recurso "restored" event.
     *
     * @param  \App\Models\Recurso  $recurso
     * @return void
     */
    public function restored(Recurso $recurso)
    {
        //
    }

    /**
     * Handle the Recurso "force deleted" event.
     *
     * @param  \App\Models\Recurso  $recurso
     * @return void
     */
    public function forceDeleted(Recurso $recurso)
    {
        //
    }
}
