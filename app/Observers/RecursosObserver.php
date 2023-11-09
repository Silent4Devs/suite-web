<?php

namespace App\Observers;

use App\Events\RecursosEvent;
use App\Mail\InvitacionCapacitacionMail;
use App\Models\Empleado;
use App\Models\Recurso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RecursosObserver
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the Recurso "created" event.
     *
     * @return void
     */
    public function created(Recurso $recurso)
    {
        // $recurso->participantes()->sync($this->request->input('participantes', []));
        $recurso->empleados()->sync($this->request->input('participantes', []));
        $empleados = Empleado::getAll()->find($this->request->input('participantes', []));
        if ($this->request->estatus == 'Draft') {
            // Code..
        } elseif ($recurso->estatus == 'Enviado') {
            if ($recurso->configuracion_invitacion_envio->enviar_ahora) {
                foreach ($empleados as $empleado) {
                    Mail::to(removeUnicodeCharacters($empleado->email))->send(new InvitacionCapacitacionMail($empleado, $recurso));
                }
            }
        }

        event(new RecursosEvent($recurso, 'create', 'recurso', 'Curso y Capacitación'));
    }

    /**
     * Handle the Recurso "updated" event.
     *
     * @return void
     */
    public function updated(Recurso $recurso)
    {
        $empleados = Empleado::getAll()->find($this->request->input('participantes', []));

        if (count($this->request->input('participantes', [])) > 0) {
            // $recurso->empleados()->detach();
            $recurso->empleados()->sync($this->request->input('participantes', []));
        }
        if ($this->request->estatus == 'Draft') {
            // Code..
        } elseif ($recurso->estatus == 'Enviado') {
            if ($recurso->configuracion_invitacion_envio->enviar_ahora) {
                foreach ($empleados as $empleado) {
                    Mail::to(removeUnicodeCharacters($empleado->email))->send(new InvitacionCapacitacionMail($empleado, $recurso));
                }
            }
        }

        event(new RecursosEvent($recurso, 'update', 'recurso', 'Curso y Capacitación'));
    }

    /**
     * Handle the Recurso "deleted" event.
     *
     * @return void
     */
    public function deleted(Recurso $recurso)
    {
        event(new RecursosEvent($recurso, 'delete', 'recurso', 'Curso y Capacitación'));
    }

    /**
     * Handle the Recurso "restored" event.
     *
     * @return void
     */
    public function restored(Recurso $recurso)
    {
        //
    }

    /**
     * Handle the Recurso "force deleted" event.
     *
     * @return void
     */
    public function forceDeleted(Recurso $recurso)
    {
        //
    }
}
