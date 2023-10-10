<?php

namespace App\Observers;

use App\Models\ExperienciaEmpleados;
use Illuminate\Support\Facades\Cache;

class ExperienciaEmpleadosObserver
{
    /**
     * Handle the ExperienciaEmpleados "created" event.
     *
     * @return void
     */
    public function created(ExperienciaEmpleados $experienciaEmpleados)
    {
        $this->forgetCache();
    }

    /**
     * Handle the ExperienciaEmpleados "updated" event.
     *
     * @return void
     */
    public function updated(ExperienciaEmpleados $experienciaEmpleados)
    {
        $this->forgetCache();
    }

    /**
     * Handle the ExperienciaEmpleados "deleted" event.
     *
     * @return void
     */
    public function deleted(ExperienciaEmpleados $experienciaEmpleados)
    {
        $this->forgetCache();
    }

    /**
     * Handle the ExperienciaEmpleados "restored" event.
     *
     * @return void
     */
    public function restored(ExperienciaEmpleados $experienciaEmpleados)
    {
        $this->forgetCache();
    }

    /**
     * Handle the ExperienciaEmpleados "force deleted" event.
     *
     * @return void
     */
    public function forceDeleted(ExperienciaEmpleados $experienciaEmpleados)
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('experienciaempleados_all');
    }
}
