<?php

namespace App\Observers;

use App\Models\Role;
use Illuminate\Support\Facades\Cache;

class RolesObserver
{
    /**
     * Handle the Role "created" event.
     */
    public function created(Role $role): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the Role "updated" event.
     */
    public function updated(Role $role): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the Role "deleted" event.
     */
    public function deleted(Role $role): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the Role "restored" event.
     */
    public function restored(Role $role): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the Role "force deleted" event.
     */
    public function forceDeleted(Role $role): void
    {
        //
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('Roles:roles_all');
    }
}
