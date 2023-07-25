<?php

namespace App\Observers;

use App\Models\SubcategoriaActivo;
use Illuminate\Support\Facades\Cache;

class SubCategoriaActivoObserver
{
    /**
     * Handle the SubcategoriaActivo "created" event.
     *
     * @return void
     */
    public function created(SubcategoriaActivo $subcategoriaActivo)
    {
        $this->forgetCache();
    }

    /**
     * Handle the SubcategoriaActivo "updated" event.
     *
     * @return void
     */
    public function updated(SubcategoriaActivo $subcategoriaActivo)
    {
        $this->forgetCache();
    }

    /**
     * Handle the SubcategoriaActivo "deleted" event.
     *
     * @return void
     */
    public function deleted(SubcategoriaActivo $subcategoriaActivo)
    {
        $this->forgetCache();
    }

    /**
     * Handle the SubcategoriaActivo "restored" event.
     *
     * @return void
     */
    public function restored(SubcategoriaActivo $subcategoriaActivo)
    {
        $this->forgetCache();
    }

    /**
     * Handle the SubcategoriaActivo "force deleted" event.
     *
     * @return void
     */
    public function forceDeleted(SubcategoriaActivo $subcategoriaActivo)
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('SubCategoriaActivo_all');
    }
}
