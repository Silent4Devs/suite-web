<?php

namespace App\Observers;

use App\Models\ListaInformativa;
use Illuminate\Support\Facades\Cache;

class ListaInformativaObserver
{
    /**
     * Handle the ListaInformativa "created" event.
     */
    public function created(ListaInformativa $listaInformativa): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the ListaInformativa "updated" event.
     */
    public function updated(ListaInformativa $listaInformativa): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the ListaInformativa "deleted" event.
     */
    public function deleted(ListaInformativa $listaInformativa): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the ListaInformativa "restored" event.
     */
    public function restored(ListaInformativa $listaInformativa): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the ListaInformativa "force deleted" event.
     */
    public function forceDeleted(ListaInformativa $listaInformativa): void
    {
        //
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('ListaInformativa:lista_informativa_all');
    }
}
