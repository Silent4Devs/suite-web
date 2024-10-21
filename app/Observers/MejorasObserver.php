<?php

namespace App\Observers;

use App\Events\MejorasEvent;
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
        event(new MejorasEvent($mejoras, 'create', 'mejoras', 'Mejora'));
        $this->forgetCache();
    }

    /**
     * Handle the Mejoras "updated" event.
     *
     * @return void
     */
    public function updated(Mejoras $mejoras)
    {
        event(new MejorasEvent($mejoras, 'update', 'mejoras', 'Mejora'));
        $this->forgetCache();
    }

    /**
     * Handle the Mejoras "deleted" event.
     *
     * @return void
     */
    public function deleted(Mejoras $mejoras)
    {
        event(new MejorasEvent($mejoras, 'delete', 'mejoras', 'Mejora'));
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('mejoras_all');
    }
}
