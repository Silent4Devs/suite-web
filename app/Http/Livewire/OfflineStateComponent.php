<?php

namespace App\Http\Livewire;

use Livewire\Component;

class OfflineStateComponent extends Component
{
    public $isOnline = true;

    public function render()
    {
        return view('livewire.offline-state-component');
    }
}
