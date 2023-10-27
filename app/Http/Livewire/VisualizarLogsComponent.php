<?php

namespace App\Http\Livewire;

use App\Models\Audit;
use Livewire\Component;
use Livewire\WithPagination;

class VisualizarLogsComponent extends Component
{
    use WithPagination;
    public $search = '';

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $articles = Audit::select('id', 'user_id', 'event', 'old_values', 'new_values', 'url', 'tags', 'created_at', 'updated_at')->with('user:id,name')
            ->orderByDesc('id')
            ->fastPaginate(50);

        return view('livewire.visualizar-logs-component', compact('articles'));
    }
}
