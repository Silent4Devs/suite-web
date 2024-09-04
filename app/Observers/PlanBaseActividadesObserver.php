<?php

namespace App\Observers;

use App\Models\PlanBaseActividade;
use Illuminate\Support\Facades\Cache;

class PlanBaseActividadesObserver
{
    /**
     * Handle the PlanBaseActividade "created" event.
     */
    public function created(PlanBaseActividade $planBaseActividade): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the PlanBaseActividade "updated" event.
     */
    public function updated(PlanBaseActividade $planBaseActividade): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the PlanBaseActividade "deleted" event.
     */
    public function deleted(PlanBaseActividade $planBaseActividade): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the PlanBaseActividade "restored" event.
     */
    public function restored(PlanBaseActividade $planBaseActividade): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the PlanBaseActividade "force deleted" event.
     */
    public function forceDeleted(PlanBaseActividade $planBaseActividade): void
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('PlanBaseActividades:PlanBaseActividades_all');
        Cache::forget('PlanBaseActividades:PlanBaseActividades_select_id');
        Cache::forget('PlanBaseActividades:PlanBaseActividades_with_actividad');
    }
}
