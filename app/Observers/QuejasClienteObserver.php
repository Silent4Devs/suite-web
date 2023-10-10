<?php

namespace App\Observers;

use App\Models\QuejasCliente;
use Illuminate\Support\Facades\Cache;

class QuejasClienteObserver
{
    /**
     * Handle the QuejasCliente "created" event.
     *
     * @param  \App\Models\QuejasCliente  $quejasCliente
     * @return void
     */
    public function created(QuejasCliente $quejasCliente)
    {
        $this->forgetCache();
    }

    /**
     * Handle the QuejasCliente "updated" event.
     *
     * @param  \App\Models\QuejasCliente  $quejasCliente
     * @return void
     */
    public function updated(QuejasCliente $quejasCliente)
    {
        $this->forgetCache();
    }

    /**
     * Handle the QuejasCliente "deleted" event.
     *
     * @param  \App\Models\QuejasCliente  $quejasCliente
     * @return void
     */
    public function deleted(QuejasCliente $quejasCliente)
    {
        $this->forgetCache();
    }

    /**
     * Handle the QuejasCliente "restored" event.
     *
     * @param  \App\Models\QuejasCliente  $quejasCliente
     * @return void
     */
    public function restored(QuejasCliente $quejasCliente)
    {
        $this->forgetCache();
    }

    /**
     * Handle the QuejasCliente "force deleted" event.
     *
     * @param  \App\Models\QuejasCliente  $quejasCliente
     * @return void
     */
    public function forceDeleted(QuejasCliente $quejasCliente)
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('quejas_cliente_all');
    }
}
