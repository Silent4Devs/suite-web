<?php

namespace App\Observers;

use App\Models\ListaDistribucion;
use Illuminate\Support\Facades\Cache;

class ListaDistribucionObserver
{
    /**
     * Handle the ListaDistribucion "created" event.
     */
    public function created(ListaDistribucion $listaDistribucion): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the ListaDistribucion "updated" event.
     */
    public function updated(ListaDistribucion $listaDistribucion): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the ListaDistribucion "deleted" event.
     */
    public function deleted(ListaDistribucion $listaDistribucion): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the ListaDistribucion "restored" event.
     */
    public function restored(ListaDistribucion $listaDistribucion): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the ListaDistribucion "force deleted" event.
     */
    public function forceDeleted(ListaDistribucion $listaDistribucion): void
    {
        //
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('ListaDistribucion:lista_distribucion_all');
    }
}
