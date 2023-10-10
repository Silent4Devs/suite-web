<?php

namespace App\Observers;

use App\Models\VersionesIso;
use Illuminate\Support\Facades\Cache;

class VersionesIsoObserver
{
    /**
     * Handle the VersionesIso "created" event.
     */
    public function created(VersionesIso $versionesIso): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the VersionesIso "updated" event.
     */
    public function updated(VersionesIso $versionesIso): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the VersionesIso "deleted" event.
     */
    public function deleted(VersionesIso $versionesIso): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the VersionesIso "restored" event.
     */
    public function restored(VersionesIso $versionesIso): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the VersionesIso "force deleted" event.
     */
    public function forceDeleted(VersionesIso $versionesIso): void
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('VersionesIso:First');
    }
}
