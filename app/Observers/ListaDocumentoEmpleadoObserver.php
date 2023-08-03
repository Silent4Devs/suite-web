<?php

namespace App\Observers;

use App\Models\ListaDocumentoEmpleado;
use Illuminate\Support\Facades\Cache;

class ListaDocumentoEmpleadoObserver
{
    /**
     * Handle the ListaDocumentoEmpleado "created" event.
     *
     * @return void
     */
    public function created(ListaDocumentoEmpleado $listaDocumentoEmpleado)
    {
        $this->forgetCache();
    }

    /**
     * Handle the ListaDocumentoEmpleado "updated" event.
     *
     * @return void
     */
    public function updated(ListaDocumentoEmpleado $listaDocumentoEmpleado)
    {
        $this->forgetCache();
    }

    /**
     * Handle the ListaDocumentoEmpleado "deleted" event.
     *
     * @return void
     */
    public function deleted(ListaDocumentoEmpleado $listaDocumentoEmpleado)
    {
        $this->forgetCache();
    }

    /**
     * Handle the ListaDocumentoEmpleado "restored" event.
     *
     * @return void
     */
    public function restored(ListaDocumentoEmpleado $listaDocumentoEmpleado)
    {
        $this->forgetCache();
    }

    /**
     * Handle the ListaDocumentoEmpleado "force deleted" event.
     *
     * @return void
     */
    public function forceDeleted(ListaDocumentoEmpleado $listaDocumentoEmpleado)
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('listasdocumentosempleados_all');
    }
}
