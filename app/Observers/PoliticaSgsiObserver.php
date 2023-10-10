<?php

namespace App\Observers;

use App\Models\PoliticaSgsi;
use Illuminate\Support\Facades\Cache;

class PoliticaSgsiObserver
{
    /**
     * Handle the PoliticaSgsi "created" event.
     *
     * @param  \App\Models\PoliticaSgsi  $politicaSgsi
     * @return void
     */
    public function created(PoliticaSgsi $politicaSgsi)
    {
        $this->forgetCache();
    }

    /**
     * Handle the PoliticaSgsi "updated" event.
     *
     * @param  \App\Models\PoliticaSgsi  $politicaSgsi
     * @return void
     */
    public function updated(PoliticaSgsi $politicaSgsi)
    {
        $this->forgetCache();
    }

    /**
     * Handle the PoliticaSgsi "deleted" event.
     *
     * @param  \App\Models\PoliticaSgsi  $politicaSgsi
     * @return void
     */
    public function deleted(PoliticaSgsi $politicaSgsi)
    {
        $this->forgetCache();
    }

    /**
     * Handle the PoliticaSgsi "restored" event.
     *
     * @param  \App\Models\PoliticaSgsi  $politicaSgsi
     * @return void
     */
    public function restored(PoliticaSgsi $politicaSgsi)
    {
        $this->forgetCache();
    }

    /**
     * Handle the PoliticaSgsi "force deleted" event.
     *
     * @param  \App\Models\PoliticaSgsi  $politicaSgsi
     * @return void
     */
    public function forceDeleted(PoliticaSgsi $politicaSgsi)
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('politicas_sgsi_all');
    }
}
