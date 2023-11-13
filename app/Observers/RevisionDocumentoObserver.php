<?php

namespace App\Observers;

use App\Models\User;
use App\Models\RevisionDocumento;
use Illuminate\Support\Facades\Cache;

class RevisionDocumentoObserver
{
    /**
     * Handle the RevisionDocumento "created" event.
     */
    public function created(RevisionDocumento $revisionDocumento): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the RevisionDocumento "updated" event.
     */
    public function updated(RevisionDocumento $revisionDocumento): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the RevisionDocumento "deleted" event.
     */
    public function deleted(RevisionDocumento $revisionDocumento): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the RevisionDocumento "restored" event.
     */
    public function restored(RevisionDocumento $revisionDocumento): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the RevisionDocumento "force deleted" event.
     */
    public function forceDeleted(RevisionDocumento $revisionDocumento): void
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('RevisionDocumento:revision_documentos_all_documentos_' . User::getCurrentUser()->empleado->id);
    }
}
