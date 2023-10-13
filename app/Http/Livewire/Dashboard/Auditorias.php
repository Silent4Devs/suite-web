<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;

// use GuzzleHttp\Psr7\Request;

class Auditorias extends Component
{
    public function render()
    {
        $prueba = 1;

        return view('livewire.dashboard.auditorias-sgi-charts.auditorias', compact(
            'prueba'
        ));
    }
}
