<?php

namespace App\Observers;

use App\Models\MatrizRequisitoLegale;
use Illuminate\Support\Facades\Cache;

class MastrizRequisitosObserver
{
    /**
     * Handle the matriz "created" event.
     *
     * @return void
     */
    public function created(MatrizRequisitoLegale $matriz)
    {
        $this->forgetCache();
    }

    /**
     * Handle the matriz "updated" event.
     *
     * @return void
     */
    public function updated(MatrizRequisitoLegale $matriz)
    {

        $this->forgetCache();
    }

    /**
     * Handle the matriz "deleted" event.
     *
     * @return void
     */
    public function deleted(MatrizRequisitoLegale $matriz)
    {

        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('matriz_sgsi_all');
    }
}
