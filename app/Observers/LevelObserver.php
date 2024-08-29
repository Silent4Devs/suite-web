<?php

namespace App\Observers;

use App\Models\Escuela\Level;
use Illuminate\Support\Facades\Cache;

class LevelObserver
{
    /**
     * Handle the Level "created" event.
     */
    public function created(Level $level): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the Level "updated" event.
     */
    public function updated(Level $level): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the Level "deleted" event.
     */
    public function deleted(Level $level): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the Level "restored" event.
     */
    public function restored(Level $level): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the Level "force deleted" event.
     */
    public function forceDeleted(Level $level): void
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('Level:level_all');
    }
}
