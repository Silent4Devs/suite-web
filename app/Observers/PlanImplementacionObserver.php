<?php

namespace App\Observers;

use App\Models\PlanImplementacion;
use Illuminate\Support\Facades\Cache;

class PlanImplementacionObserver
{
    public function created(PlanImplementacion $planImplementacion)
    {
        $this->forgetCache();
    }

    public function updated(PlanImplementacion $planImplementacion)
    {
        $this->forgetCache();
    }

    public function deleted(PlanImplementacion $planImplementacion)
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('PlanImplementacion:plan_implementacion_all');
        Cache::forget('PlanImplementacion:implementaciones_first');
    }
}
