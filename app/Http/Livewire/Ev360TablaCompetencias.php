<?php

namespace App\Http\Livewire;

use App\Models\RH\Competencia;
use App\Models\RH\TipoCompetencia;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Ev360TablaCompetencias extends Component
{
    use LivewireAlert;
    use WithPagination;

    public $showTable = false;

    public $search = '';

    public $perPage = 10;

    public $filter = 1;

    public $selected = [];

    public function mount($showTable)
    {
        $this->showTable = $showTable;
    }

    public function render()
    {
        $competencias = collect();
        if ($this->showTable) {
            $competencias = Competencia::search($this->search)->simplePaginate($this->perPage);
        }
        $tipos = TipoCompetencia::select('id', 'nombre')->get();

        return view('livewire.ev360-tabla-competencias', ['competencias' => $competencias, 'tipos' => $tipos]);
    }
}
