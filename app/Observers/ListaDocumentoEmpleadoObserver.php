<?php

namespace App\Observers;

use Illuminate\Support\Facades\Cache;
use App\Models\ListaDocumentoEmpleado;

class ListaDocumentoEmpleadoObserver
{
    /**
     * Handle the ListaDocumentoEmpleado "created" event.
     *
     * @param  \App\Models\ListaDocumentoEmpleado  $listaDocumentoEmpleado
     * @return void
     */
    public function created(ListaDocumentoEmpleado $listaDocumentoEmpleado)
    {
        $this->forgetCache();
    }

    /**
     * Handle the ListaDocumentoEmpleado "updated" event.
     *
     * @param  \App\Models\ListaDocumentoEmpleado  $listaDocumentoEmpleado
     * @return void
     */
    public function updated(ListaDocumentoEmpleado $listaDocumentoEmpleado)
    {
        $this->forgetCache();
    }

    /**
     * Handle the ListaDocumentoEmpleado "deleted" event.
     *
     * @param  \App\Models\ListaDocumentoEmpleado  $listaDocumentoEmpleado
     * @return void
     */
    public function deleted(ListaDocumentoEmpleado $listaDocumentoEmpleado)
    {
        $this->forgetCache();
    }

    /**
     * Handle the ListaDocumentoEmpleado "restored" event.
     *
     * @param  \App\Models\ListaDocumentoEmpleado  $listaDocumentoEmpleado
     * @return void
     */
    public function restored(ListaDocumentoEmpleado $listaDocumentoEmpleado)
    {
        $this->forgetCache();
    }

    /**
     * Handle the ListaDocumentoEmpleado "force deleted" event.
     *
     * @param  \App\Models\ListaDocumentoEmpleado  $listaDocumentoEmpleado
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
