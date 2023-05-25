<?php

namespace App\Http\Livewire;

use App\Models\Area;
use Livewire\Component;

class SelectAreasComponent extends Component
{

    protected $listeners = ['render' => 'render'];

    public function render()
    {
        $areas = Area::orderByDesc('id')->get();

        return view('livewire.timesheet.select-areas-component', compact('areas'));
    }

}
