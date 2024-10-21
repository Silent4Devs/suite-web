<?php

namespace App\Observers;

use App\Models\ParticipantesListaDistribucion;
use Illuminate\Support\Facades\Cache;

class ParticipantesListaDistribucionObserver
{
    /**
     * Handle the ParticipantesListaDistribucion "created" event.
     */
    public function created(ParticipantesListaDistribucion $participantesListaDistribucion): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the ParticipantesListaDistribucion "updated" event.
     */
    public function updated(ParticipantesListaDistribucion $participantesListaDistribucion): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the ParticipantesListaDistribucion "deleted" event.
     */
    public function deleted(ParticipantesListaDistribucion $participantesListaDistribucion): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the ParticipantesListaDistribucion "restored" event.
     */
    public function restored(ParticipantesListaDistribucion $participantesListaDistribucion): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the ParticipantesListaDistribucion "force deleted" event.
     */
    public function forceDeleted(ParticipantesListaDistribucion $participantesListaDistribucion): void
    {
        //
        $this->forgetCache();
    }

    public function forgetCache()
    {
        Cache::forget('ListaDistribucion:lista_distribucion_all');
    }
}
