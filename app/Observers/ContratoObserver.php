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
        try {
            event(new ContratoEvent($contrato, 'create', 'contratos', 'Contratos'));
        } catch (\Throwable $th) {
            //throw $th;
        }

        $this->forgetCache();
    }

    /**
     * Handle the Contrato "updated" event.
     */
    public function updated(Contrato $contrato): void
    {
        try {
            event(new ContratoEvent($contrato, 'update', 'contratos', 'Contratos'));
        } catch (\Throwable $th) {
            //throw $th;
        }

        $this->forgetCache();
    }

    /**
     * Handle the Contrato "deleted" event.
     */
    public function deleted(Contrato $contrato): void
    {
        try {
            event(new ContratoEvent($contrato, 'delete', 'contratos', 'Contratos'));
        } catch (\Throwable $th) {
            //throw $th;
        }

        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('Contratos:contratos_all');
    }
}
