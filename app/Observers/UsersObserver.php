<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Cache;

class UsersObserver
{
    /**
     * Handle the User "created" event.
     *
     * @return void
     */
    public function created(User $user)
    {
        $this->forgetCache();
    }

    /**
     * Handle the User "updated" event.
     *
     * @return void
     */
    public function updated(User $user)
    {
        $this->forgetCache();
    }

    /**
     * Handle the User "deleted" event.
     *
     * @return void
     */
    public function deleted(User $user)
    {
        $this->forgetCache();
    }

    /**
     * Handle the User "restored" event.
     *
     * @return void
     */
    public function restored(User $user)
    {
        $this->forgetCache();
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @return void
     */
    public function forceDeleted(User $user)
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('Users:users_all');
        Cache::forget('Auth_user:user' . auth()->user()->id);
        Cache::forget('Users:users_exists');
    }
}
