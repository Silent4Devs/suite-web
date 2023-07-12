<?php

namespace App\Observers;

use App\Models\Area;
use Illuminate\Support\Facades\Cache;

class AreasObserver
{
    /**
     * Handle the Area "created" event.
     *
     * @param  \App\Models\Area  $area
     * @return void
     */
    public function created(Area $area)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Area "updated" event.
     *
     * @param  \App\Models\Area  $area
     * @return void
     */
    public function updated(Area $area)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Area "deleted" event.
     *
     * @param  \App\Models\Area  $area
     * @return void
     */
    public function deleted(Area $area)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Area "restored" event.
     *
     * @param  \App\Models\Area  $area
     * @return void
     */
    public function restored(Area $area)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Area "force deleted" event.
     *
     * @param  \App\Models\Area  $area
     * @return void
     */
    public function forceDeleted(Area $area)
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('areas_all');
    }
}
