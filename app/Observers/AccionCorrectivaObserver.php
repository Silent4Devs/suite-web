<?php

namespace App\Observers;

use App\Events\AccionCorrectivaEvent;
use App\Models\AccionCorrectiva;
use Illuminate\Support\Facades\Cache;

class AccionCorrectivaObserver
{
    /**
     * Handle the AccionCorrectiva "created" event.
     *
     * @return void
     */
    public function created(AccionCorrectiva $accionCorrectiva)
    {
        event(new AccionCorrectivaEvent($accionCorrectiva, 'create', 'accion-correctiva', 'Acción Correctiva'));
        $this->forgetCache();
    }

    /**
     * Handle the AccionCorrectiva "updated" event.
     *
     * @return void
     */
    public function updated(AccionCorrectiva $accionCorrectiva)
    {
        event(new AccionCorrectivaEvent($accionCorrectiva, 'update', 'accion-correctiva', 'Acción Correctiva'));
        $this->forgetCache();
    }

    /**
     * Handle the AccionCorrectiva "deleted" event.
     *
     * @return void
     */
    public function deleted(AccionCorrectiva $accionCorrectiva)
    {
        event(new AccionCorrectivaEvent($accionCorrectiva, 'delete', 'accion-correctiva', 'Acción Correctiva'));
        $this->forgetCache();
    }

    /**
     * Handle the AccionCorrectiva "restored" event.
     *
     * @return void
     */
    public function restored(AccionCorrectiva $accionCorrectiva)
    {
        $this->forgetCache();
    }

    /**
     * Handle the AccionCorrectiva "force deleted" event.
     *
     * @return void
     */
    public function forceDeleted(AccionCorrectiva $accionCorrectiva)
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('AccionCorrectiva:get_all');
    }
}
