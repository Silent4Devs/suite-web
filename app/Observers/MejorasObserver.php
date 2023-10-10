<?php

namespace App\Observers;

use App\Models\Mejoras;
use Illuminate\Support\Facades\Cache;

class MejorasObserver
{
    /**
     * Handle the Mejoras "created" event.
     *
     * @param  \App\Models\Mejoras  $mejoras
     * @return void
     */
    public function created(Mejoras $mejoras)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Mejoras "updated" event.
     *
     * @param  \App\Models\Mejoras  $mejoras
     * @return void
     */
    public function updated(Mejoras $mejoras)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Mejoras "deleted" event.
     *
     * @param  \App\Models\Mejoras  $mejoras
     * @return void
     */
    public function deleted(Mejoras $mejoras)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Mejoras "restored" event.
     *
     * @param  \App\Models\Mejoras  $mejoras
     * @return void
     */
    public function restored(Mejoras $mejoras)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Mejoras "force deleted" event.
     *
     * @param  \App\Models\Mejoras  $mejoras
     * @return void
     */
    public function forceDeleted(Mejoras $mejoras)
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('mejoras_all');
    }
}
