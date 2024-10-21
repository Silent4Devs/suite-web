<?php

namespace App\Observers;

use App\Events\QuejasEvent;
use App\Models\Quejas;
use Illuminate\Support\Facades\Cache;

class QuejasObserver
{
    /**
     * Handle the Quejas "created" event.
     *
     * @return void
     */
    public function created(Quejas $quejas)
    {
        event(new QuejasEvent($quejas, 'create', 'quejas', 'Queja'));
        $this->forgetCache();
    }

    /**
     * Handle the Quejas "updated" event.
     *
     * @return void
     */
    public function updated(Quejas $quejas)
    {
        event(new QuejasEvent($quejas, 'update', 'quejas', 'Queja'));
        $this->forgetCache();
    }

    /**
     * Handle the Quejas "deleted" event.
     *
     * @return void
     */
    public function deleted(Quejas $quejas)
    {
        event(new QuejasEvent($quejas, 'delete', 'quejas', 'Queja'));
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('quejas_all');
    }
}
