<?php

namespace App\Http\Livewire;

use App\Models\Audit;
use Livewire\Component;
use Livewire\WithPagination;

class VisualizarLogsComponent extends Component
{
    use WithPagination;

    public function render()
    {
        $articles = Audit::get();

        return view('livewire.visualizar-logs-component', [
            'articles' => $articles,
        ]);
    }
}
