<?php

namespace App\Observers;

use App\Models\AuditoriaInterna;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

class AuditoriaInternaObserver
{
    /**
     * Handle the AuditoriaInterna "created" event.
     */
    public function created(AuditoriaInterna $auditoriaInterna): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the AuditoriaInterna "updated" event.
     */
    public function updated(AuditoriaInterna $auditoriaInterna): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the AuditoriaInterna "deleted" event.
     */
    public function deleted(AuditoriaInterna $auditoriaInterna): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the AuditoriaInterna "restored" event.
     */
    public function restored(AuditoriaInterna $auditoriaInterna): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the AuditoriaInterna "force deleted" event.
     */
    public function forceDeleted(AuditoriaInterna $auditoriaInterna): void
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('AuditoriaInterna:auditoria_internas_'.User::getCurrentUser()->id);
    }
}
