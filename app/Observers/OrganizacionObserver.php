<?php

namespace App\Observers;

use App\Models\Organizacion;
use Illuminate\Support\Facades\Cache;

class OrganizacionObserver
{
    /**
     * Handle the Organizacion "created" event.
     *
     * @param  \App\Models\Organizacion  $organizacion
     * @return void
     */
    public function created(Organizacion $organizacion)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Organizacion "updated" event.
     *
     * @param  \App\Models\Organizacion  $organizacion
     * @return void
     */
    public function updated(Organizacion $organizacion)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Organizacion "deleted" event.
     *
     * @param  \App\Models\Organizacion  $organizacion
     * @return void
     */
    public function deleted(Organizacion $organizacion)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Organizacion "restored" event.
     *
     * @param  \App\Models\Organizacion  $organizacion
     * @return void
     */
    public function restored(Organizacion $organizacion)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Organizacion "force deleted" event.
     *
     * @param  \App\Models\Organizacion  $organizacion
     * @return void
     */
    public function forceDeleted(Organizacion $organizacion)
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('getLogo_organizacion');
        Cache::forget('organization_all');
        Cache::forget('organizacion_first');
    }
}
