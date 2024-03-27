<?php

namespace App\Observers;

use App\Models\Documento;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

class DocumentoObserver
{
    /**
     * Handle the Documento "created" event.
     */
    public function created(Documento $documento): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the Documento "updated" event.
     */
    public function updated(Documento $documento): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the Documento "deleted" event.
     */
    public function deleted(Documento $documento): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the Documento "restored" event.
     */
    public function restored(Documento $documento): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the Documento "force deleted" event.
     */
    public function forceDeleted(Documento $documento): void
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        $user = User::getCurrentUser();
        Cache::forget('Documentos:Documentos_all_macroprocesos_'.$user->empleado_id);
    }
}
