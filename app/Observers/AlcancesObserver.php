<?php

namespace App\Observers;

use App\Events\AlcancesEvent;
use App\Models\AlcanceSgsi;
use Illuminate\Support\Facades\Cache;

class AlcancesObserver
{
    /**
     * Handle the alcances "created" event.
     *
     * @return void
     */
    public function created(AlcanceSgsi $alcances)
    {
        event(new AlcancesEvent($alcances, 'create', 'alcance_sgsis', 'Alcances'));

        $this->forgetCache();
    }

    /**
     * Handle the alcances "updated" event.
     *
     * @return void
     */
    public function updated(AlcanceSgsi $alcances)
    {
        event(new AlcancesEvent($alcances, 'update', 'alcance_sgsis', 'Alcances'));

        $this->forgetCache();
    }

    /**
     * Handle the alcances "deleted" event.
     *
     * @return void
     */
    public function deleted(AlcanceSgsi $alcances)
    {
        event(new AlcancesEvent($alcances, 'delete', 'alcance_sgsis', 'Alcances'));

        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('alcances_sgsi_all');
    }
}
