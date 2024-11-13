<?php

namespace App\Observers;

use App\Events\ContratoEvent;
use App\Models\ContractManager\Contrato;
use Illuminate\Support\Facades\Cache;

class ContratoObserver
{
    /**
     * Handle the Contrato "created" event.
     */
    public function created(Contrato $contrato): void
    {
        // event(new ContratoEvent($contrato, 'create', 'contratos', 'Contratos'));

        $this->forgetCache();
    }

    /**
     * Handle the Contrato "updated" event.
     */
    public function updated(Contrato $contrato): void
    {
        // event(new ContratoEvent($contrato, 'update', 'contratos', 'Contratos'));

        $this->forgetCache();
    }

    /**
     * Handle the Contrato "deleted" event.
     */
    public function deleted(Contrato $contrato): void
    {
        // event(new ContratoEvent($contrato, 'delete', 'contratos', 'Contratos'));

        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('Contratos:contratos_all');
    }
}
