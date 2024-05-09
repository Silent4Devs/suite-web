<?php

namespace App\Observers;

use App\Events\PlanImplementacionEvent;
use App\Models\PlanImplementacion;
use Illuminate\Support\Facades\Cache;

class PlanImplementacionObserver
{
    public function created(PlanImplementacion $planImplementacion)
    {
        event(new PlanImplementacionEvent($planImplementacion, 'create', 'plan_implementacions', 'Plan de Trabajo'));
        $this->forgetCache();
    }

    public function updated(PlanImplementacion $planImplementacion)
    {
        event(new PlanImplementacionEvent($planImplementacion, 'update', 'plan_implementacions', 'Plan de Trabajo'));
        $this->forgetCache();
    }

    public function deleted(PlanImplementacion $planImplementacion)
    {
        event(new PlanImplementacionEvent($planImplementacion, 'delete', 'plan_implementacions', 'Plan de Trabajo'));
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('PlanImplementacion:plan_implementacion_all');
        Cache::forget('PlanImplementacion:implementaciones_first');
    }
}