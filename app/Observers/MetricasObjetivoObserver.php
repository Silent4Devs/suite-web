<?php

namespace App\Observers;

use App\Models\RH\MetricasObjetivo;
use Illuminate\Support\Facades\Cache;

class MetricasObjetivoObserver
{
    /**
     * Handle the MetricasObjetivo "created" event.
     *
     * @param  \App\Models\MetricasObjetivo  $metricasObjetivo
     * @return void
     */
    public function created(MetricasObjetivo $metricasObjetivo)
    {
        $this->forgetCache();
    }

    /**
     * Handle the MetricasObjetivo "updated" event.
     *
     * @param  \App\Models\MetricasObjetivo  $metricasObjetivo
     * @return void
     */
    public function updated(MetricasObjetivo $metricasObjetivo)
    {
        $this->forgetCache();
    }

    /**
     * Handle the MetricasObjetivo "deleted" event.
     *
     * @param  \App\Models\MetricasObjetivo  $metricasObjetivo
     * @return void
     */
    public function deleted(MetricasObjetivo $metricasObjetivo)
    {
        $this->forgetCache();
    }

    /**
     * Handle the MetricasObjetivo "restored" event.
     *
     * @param  \App\Models\MetricasObjetivo  $metricasObjetivo
     * @return void
     */
    public function restored(MetricasObjetivo $metricasObjetivo)
    {
        $this->forgetCache();
    }

    /**
     * Handle the MetricasObjetivo "force deleted" event.
     *
     * @param  \App\Models\MetricasObjetivo  $metricasObjetivo
     * @return void
     */
    public function forceDeleted(MetricasObjetivo $metricasObjetivo)
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('MetricasObjetivos_all');
    }
}
