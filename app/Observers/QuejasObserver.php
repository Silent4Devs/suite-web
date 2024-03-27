<?php

namespace App\Observers;

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
        $this->forgetCache();
    }

    /**
     * Handle the Quejas "updated" event.
     *
     * @return void
     */
    public function updated(Quejas $quejas)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Quejas "deleted" event.
     *
     * @return void
     */
    public function deleted(Quejas $quejas)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Quejas "restored" event.
     *
     * @return void
     */
    public function restored(Quejas $quejas)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Quejas "force deleted" event.
     *
     * @return void
     */
    public function forceDeleted(Quejas $quejas)
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('quejas_all');
    }
}
