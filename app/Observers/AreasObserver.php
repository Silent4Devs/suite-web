<?php

namespace App\Observers;

use App\Models\Area;
use Illuminate\Support\Facades\Cache;

class AreasObserver
{
    /**
     * Handle the Area "created" event.
     *
     * @return void
     */
    public function created(Area $area)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Area "updated" event.
     *
     * @return void
     */
    public function updated(Area $area)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Area "deleted" event.
     *
     * @return void
     */
    public function deleted(Area $area)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Area "restored" event.
     *
     * @return void
     */
    public function restored(Area $area)
    {
        $this->forgetCache();
    }

    /**
     * Handle the Area "force deleted" event.
     *
     * @return void
     */
    public function forceDeleted(Area $area)
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('Areas:areas_all');
        Cache::forget('Areas:Areas_exists');
    }
}
