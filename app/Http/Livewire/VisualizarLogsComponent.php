<?php

namespace App\Http\Livewire;

use Livewire\Component;

class VisualizarLogsComponent extends Component
{
    public function render()
    {
        $articles = Article::all();
        dd($articles);

        return view('livewire.visualizar-logs-component');
    }
}
