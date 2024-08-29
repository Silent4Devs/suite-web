<?php

namespace App\Observers;

use App\Events\DocumentoEvent;
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
        event(new DocumentoEvent($documento, 'create', 'documentos', 'Documento'));
        $this->forgetCache();
    }

    /**
     * Handle the Documento "updated" event.
     */
    public function updated(Documento $documento): void
    {
        event(new DocumentoEvent($documento, 'update', 'documentos', 'Documento'));
        $this->forgetCache();
    }

    /**
     * Handle the Documento "deleted" event.
     */
    public function deleted(Documento $documento): void
    {
        event(new DocumentoEvent($documento, 'delete', 'documentos', 'Documento'));
        $this->forgetCache();
    }

    private function forgetCache()
    {
        $user = User::getCurrentUser();
        Cache::forget('Documentos:Documentos_all_macroprocesos_'.$user->empleado_id);
    }
}
