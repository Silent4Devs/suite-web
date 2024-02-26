<?php

namespace App\Observers;

use App\Models\RH\CatalogoRangosObjetivos;
use Illuminate\Support\Facades\Cache;

class CatalogoRangosObjetivosObserver
{
    /**
     * Handle the CatalogoRangosObjetivos "created" event.
     */
    public function created(CatalogoRangosObjetivos $catalogoRangosObjetivos): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the CatalogoRangosObjetivos "updated" event.
     */
    public function updated(CatalogoRangosObjetivos $catalogoRangosObjetivos): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the CatalogoRangosObjetivos "deleted" event.
     */
    public function deleted(CatalogoRangosObjetivos $catalogoRangosObjetivos): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the CatalogoRangosObjetivos "restored" event.
     */
    public function restored(CatalogoRangosObjetivos $catalogoRangosObjetivos): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the CatalogoRangosObjetivos "force deleted" event.
     */
    public function forceDeleted(CatalogoRangosObjetivos $catalogoRangosObjetivos): void
    {
        //
        $this->forgetCache();
    }

    public function forgetCache()
    {
        Cache::forget('CatalogosRangos:catalogos_rangos_all');
    }
}
