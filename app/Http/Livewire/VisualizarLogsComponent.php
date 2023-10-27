<?php

namespace App\Http\Livewire;

use App\Models\Audit;
use Livewire\Component;
use Livewire\WithPagination;

class VisualizarLogsComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.visualizar-logs-component', [
            'articles' => Audit::orderByDesc('id')->paginate(10),
        ]);
    }
}
