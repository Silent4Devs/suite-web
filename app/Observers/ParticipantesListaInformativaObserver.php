<?php

namespace App\Observers;

use App\Models\ParticipantesListaInformativa;
use Illuminate\Support\Facades\Cache;

class ParticipantesListaInformativaObserver
{
    /**
     * Handle the ParticipantesListaInformativa "created" event.
     */
    public function created(ParticipantesListaInformativa $participantesListaInformativa): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the ParticipantesListaInformativa "updated" event.
     */
    public function updated(ParticipantesListaInformativa $participantesListaInformativa): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the ParticipantesListaInformativa "deleted" event.
     */
    public function deleted(ParticipantesListaInformativa $participantesListaInformativa): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the ParticipantesListaInformativa "restored" event.
     */
    public function restored(ParticipantesListaInformativa $participantesListaInformativa): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the ParticipantesListaInformativa "force deleted" event.
     */
    public function forceDeleted(ParticipantesListaInformativa $participantesListaInformativa): void
    {
        //
        $this->forgetCache();
    }

    public function forgetCache()
    {
        Cache::forget('ListaInformativa:lista_informativa_all');
    }
}
