<?php

namespace App\Observers;

use App\Events\TemplateAnalisisRiesgosEvent;

class TemplateAnalisisRiesgosObserver
{
    //
    public function created($model)
    {
        event(new TemplateAnalisisRiesgosEvent($model, 'create'));
    }

    //
    public function updated($model): void
    {
        event(new TemplateAnalisisRiesgosEvent($model, 'update'));
    }

    public function deleted($model): void
    {
        event(new TemplateAnalisisRiesgosEvent($model, 'delete'));
    }
}
