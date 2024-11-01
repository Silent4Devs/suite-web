<?php

namespace App\Observers;

use App\Events\PoliticasSgiEvent;
use App\Models\PoliticaSgsi;
use Illuminate\Support\Facades\Cache;

class PoliticaSgsiObserver
{
    /**
     * Handle the PoliticaSgsi "created" event.
     *
     * @return void
     */
    // public function created(PoliticaSgsi $politicaSgsi)
    // {
    //     event(new PoliticasSgiEvent($politicaSgsi, 'create', 'politica_sgsis', 'Politica'));

    //     $this->forgetCache();
    // }

    /**
     * Handle the PoliticaSgsi "updated" event.
     *
     * @return void
     */
    // public function updated(PoliticaSgsi $politicaSgsi)
    // {
    //     event(new PoliticasSgiEvent($politicaSgsi, 'update', 'politica_sgsis', 'Politica'));

    //     $this->forgetCache();
    // }

    /**
     * Handle the PoliticaSgsi "deleted" event.
     *
     * @return void
     */
    // public function deleted(PoliticaSgsi $politicaSgsi)
    // {
    //     event(new PoliticasSgiEvent($politicaSgsi, 'delete', 'politica_sgsis', 'Politica'));

    //     $this->forgetCache();
    // }

    private function forgetCache()
    {
        Cache::forget('politicas_sgsi_all');
    }
}
