<?php

namespace App\Observers;

use App\Models\Vulnerabilidad;
use Illuminate\Support\Facades\Cache;

class VulnerabilidadObserver
{
    /**
     * Handle the Vulnerabilidad "created" event.
     */
    public function created(Vulnerabilidad $vulnerabilidad): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the Vulnerabilidad "updated" event.
     */
    public function updated(Vulnerabilidad $vulnerabilidad): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the Vulnerabilidad "deleted" event.
     */
    public function deleted(Vulnerabilidad $vulnerabilidad): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the Vulnerabilidad "restored" event.
     */
    public function restored(Vulnerabilidad $vulnerabilidad): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the Vulnerabilidad "force deleted" event.
     */
    public function forceDeleted(Vulnerabilidad $vulnerabilidad): void
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {

        Cache::forget('Vulnerabilidades:vulnerabilidad_all');
    }
}
