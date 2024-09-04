<?php

namespace App\Observers;

use App\Models\ContractManager\Contrato;
use Illuminate\Support\Facades\Cache;

class ContratoObserver
{
    /**
     * Handle the Contrato "created" event.
     */
    public function created(Contrato $contrato): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the Contrato "updated" event.
     */
    public function updated(Contrato $contrato): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the Contrato "deleted" event.
     */
    public function deleted(Contrato $contrato): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the Contrato "restored" event.
     */
    public function restored(Contrato $contrato): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the Contrato "force deleted" event.
     */
    public function forceDeleted(Contrato $contrato): void
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('Courses:courses_all');
    }
}
