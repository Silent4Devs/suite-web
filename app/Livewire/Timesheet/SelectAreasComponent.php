<?php

namespace App\Http\Livewire;

use App\Models\Area;
use Livewire\Component;

namespace App\Livewire\Timesheet extends Component
{
    protected $listeners = ['render' => 'render'];

    public function render()
    {
        $areas = Area::getAll();

        return view('class SelectAreasComponent', compact('areas'));
    }
}
