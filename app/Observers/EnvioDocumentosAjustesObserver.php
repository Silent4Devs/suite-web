<?php

namespace App\Observers;

use Illuminate\Support\Facades\Cache;
use App\Models\EnvioDocumentosAjustes;

class EnvioDocumentosAjustesObserver
{
    /**
     * Handle the EnvioDocumentosAjustes "created" event.
     */
    public function created(EnvioDocumentosAjustes $EnvioDocumentosAjustes): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the EnvioDocumentosAjustes "updated" event.
     */
    public function updated(EnvioDocumentosAjustes $EnvioDocumentosAjustes): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the EnvioDocumentosAjustes "deleted" event.
     */
    public function deleted(EnvioDocumentosAjustes $EnvioDocumentosAjustes): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the EnvioDocumentosAjustes "restored" event.
     */
    public function restored(EnvioDocumentosAjustes $EnvioDocumentosAjustes): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the EnvioDocumentosAjustes "force deleted" event.
     */
    public function forceDeleted(EnvioDocumentosAjustes $EnvioDocumentosAjustes): void
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('EnvioDocumentosAjustes:EnviodocumentosAjustes_with_coordinador_mensajero');
    }
}
