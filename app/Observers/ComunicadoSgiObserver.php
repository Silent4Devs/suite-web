<?php

namespace App\Observers;

use App\Models\ComunicacionSgi;
use Illuminate\Support\Facades\Cache;

class ComunicadoSgiObserver
{
    /**
     * Handle the ComunicacionSgi "created" event.
     */
    public function created(ComunicacionSgi $comunicacionSgi): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the ComunicacionSgi "updated" event.
     */
    public function updated(ComunicacionSgi $comunicacionSgi): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the ComunicacionSgi "deleted" event.
     */
    public function deleted(ComunicacionSgi $comunicacionSgi): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the ComunicacionSgi "restored" event.
     */
    public function restored(ComunicacionSgi $comunicacionSgi): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the ComunicacionSgi "force deleted" event.
     */
    public function forceDeleted(ComunicacionSgi $comunicacionSgi): void
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('ComunicacionSGI:get_all_with_imagenes');
        Cache::forget('Portal:get_all_with_imagenes_blog');
        Cache::forget('Portal:get_all_with_imagenes_carrousel');
        Cache::forget('Portal:portal_aniversarios');
        Cache::forget('Portal:portal_aniversarios_contador_circulo');
    }
}
