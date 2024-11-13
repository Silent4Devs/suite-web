<?php

namespace App\Observers;

use App\Models\EvidenciasDocumentosEmpleados;
use Illuminate\Support\Facades\Cache;

class EvidenciasDocumentosEmpleadosObserver
{
    /**
     * Handle the EvidenciasDocumentosEmpleados "created" event.
     */
    public function created(EvidenciasDocumentosEmpleados $evidenciasDocumentosEmpleados): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the EvidenciasDocumentosEmpleados "updated" event.
     */
    public function updated(EvidenciasDocumentosEmpleados $evidenciasDocumentosEmpleados): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the EvidenciasDocumentosEmpleados "deleted" event.
     */
    public function deleted(EvidenciasDocumentosEmpleados $evidenciasDocumentosEmpleados): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the EvidenciasDocumentosEmpleados "restored" event.
     */
    public function restored(EvidenciasDocumentosEmpleados $evidenciasDocumentosEmpleados): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the EvidenciasDocumentosEmpleados "force deleted" event.
     */
    public function forceDeleted(EvidenciasDocumentosEmpleados $evidenciasDocumentosEmpleados): void
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('EvidenciasDocumentos:revision_documentos_all');
    }
}
