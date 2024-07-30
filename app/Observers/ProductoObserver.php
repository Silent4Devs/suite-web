<?php

namespace App\Observers;

use App\Models\ContractManager\Producto;
use Illuminate\Support\Facades\Cache;

class ProductoObserver
{
    /**
     * Handle the Producto "created" event.
     */
    public function created(Producto $producto): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the Producto "updated" event.
     */
    public function updated(Producto $producto): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the Producto "deleted" event.
     */
    public function deleted(Producto $producto): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the Producto "restored" event.
     */
    public function restored(Producto $producto): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the Producto "force deleted" event.
     */
    public function forceDeleted(Producto $producto): void
    {
        //
        $this->forgetCache();
    }

    public function forgetCache()
    {
        Cache::forget('Producto:Producto_all');
        Cache::forget('Producto:Producto_archivo_false');
        Cache::forget('Producto:Producto_archivo_true');
    }
}
