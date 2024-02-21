<?php

namespace App\Observers;

use Illuminate\Support\Facades\Cache;
use App\Models\CategoriaCapacitacion;

class CategoriaCapacitacionObserver
{
    /**
     * Handle the CategoriaCapacitacion "created" event.
     */
    public function created(CategoriaCapacitacion $categoriaCapacitacion): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the CategoriaCapacitacion "updated" event.
     */
    public function updated(CategoriaCapacitacion $categoriaCapacitacion): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the CategoriaCapacitacion "deleted" event.
     */
    public function deleted(CategoriaCapacitacion $categoriaCapacitacion): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the CategoriaCapacitacion "restored" event.
     */
    public function restored(CategoriaCapacitacion $categoriaCapacitacion): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the CategoriaCapacitacion "force deleted" event.
     */
    public function forceDeleted(CategoriaCapacitacion $categoriaCapacitacion): void
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('CategoriaCapacitacion:categoriacapacitacion_all');
        Cache::forget('CategoriaCapacitacion:categoriacapacitacion_with_recursos');
    }
}
