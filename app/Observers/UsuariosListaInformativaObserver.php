<?php

namespace App\Observers;

use App\Models\UsuariosListaInformativa;
use Illuminate\Support\Facades\Cache;

class UsuariosListaInformativaObserver
{
    /**
     * Handle the UsuariosListaInformativa "created" event.
     */
    public function created(UsuariosListaInformativa $usuariosListaInformativa): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the UsuariosListaInformativa "updated" event.
     */
    public function updated(UsuariosListaInformativa $usuariosListaInformativa): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the UsuariosListaInformativa "deleted" event.
     */
    public function deleted(UsuariosListaInformativa $usuariosListaInformativa): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the UsuariosListaInformativa "restored" event.
     */
    public function restored(UsuariosListaInformativa $usuariosListaInformativa): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the UsuariosListaInformativa "force deleted" event.
     */
    public function forceDeleted(UsuariosListaInformativa $usuariosListaInformativa): void
    {
        //
        $this->forgetCache();
    }

    public function forgetCache()
    {
        Cache::forget('ListaInformativa:lista_informativa_all');
    }
}
