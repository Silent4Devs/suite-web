<?php

namespace App\Observers;

use App\Events\DenunciasEvent;
use App\Models\Denuncias;
use Illuminate\Support\Facades\Cache;

class DenunciasObserver
{
    /**
     * Handle the Denuncias "created" event.
     *
     * @return void
     */
    public function created(Denuncias $denuncias)
    {

        try {
            event(new DenunciasEvent($denuncias, 'create', 'denuncias', 'Denuncia'));
        } catch (\Throwable $th) {
            // throw $th;
        }
        $this->forgetCache();
    }

    /**
     * Handle the Denuncias "updated" event.
     *
     * @return void
     */
    public function updated(Denuncias $denuncias)
    {

        try {
            event(new DenunciasEvent($denuncias, 'update', 'denuncias', 'Denuncia'));
        } catch (\Throwable $th) {
            // throw $th;
        }
        $this->forgetCache();
    }

    /**
     * Handle the Denuncias "deleted" event.
     *
     * @return void
     */
    public function deleted(Denuncias $denuncias)
    {

        try {
            event(new DenunciasEvent($denuncias, 'delete', 'denuncias', 'Denuncia'));
        } catch (\Throwable $th) {
            // throw $th;
        }
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('denuncias_all');
    }
}
