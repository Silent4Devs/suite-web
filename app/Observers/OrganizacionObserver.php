<?php

namespace App\Observers;

use App\Models\Organizacion;
use Illuminate\Support\Facades\Cache;

class OrganizacionObserver
{
    /**
     * Handle the Organizacion "created" event.
     *
     * @return void
     */
    public function created(Organizacion $organizacion)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Organizacion "updated" event.
     *
     * @return void
     */
    public function updated(Organizacion $organizacion)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Organizacion "deleted" event.
     *
     * @return void
     */
    public function deleted(Organizacion $organizacion)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Organizacion "restored" event.
     *
     * @return void
     */
    public function restored(Organizacion $organizacion)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Organizacion "force deleted" event.
     *
     * @return void
     */
    public function forceDeleted(Organizacion $organizacion)
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('Organizacion:getLogo_organizacion');
        Cache::forget('Organizacion:organization_all');
        Cache::forget('Organizacion:organizacion_first');
        Cache::forget('Organizacion:Organizacion_exists');
        Cache::forget('Organizacion:fecha_registro_timesheet');
    }
}
