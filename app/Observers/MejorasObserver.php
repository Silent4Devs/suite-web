<?php

namespace App\Observers;

use App\Models\Mejoras;
use Illuminate\Support\Facades\Cache;

class MejorasObserver
{
    /**
     * Handle the Mejoras "created" event.
     *
     * @return void
     */
    public function created(Mejoras $mejoras)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Mejoras "updated" event.
     *
     * @return void
     */
    public function updated(Mejoras $mejoras)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Mejoras "deleted" event.
     *
     * @return void
     */
    public function deleted(Mejoras $mejoras)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Mejoras "restored" event.
     *
     * @return void
     */
    public function restored(Mejoras $mejoras)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Mejoras "force deleted" event.
     *
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
