<?php

namespace App\Livewire\CedulaCumplimiento;

use App\Models\ContractManager\HistoricoCedulaCumplimiento;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class HistoricoComponent extends Component
{
    use LivewireAlert, WithPagination;

    public $cedula_id;

    public $listeners = [
        'renderHistorico' => 'render',
    ];

    public function mount($cedula_id)
    {
        $this->cedula_id = $cedula_id;
    }

    public function render()
    {
        $items_historico = HistoricoCedulaCumplimiento::where('id_cedula', '=', $this->cedula_id)->get();

        return view('livewire.cedula-cumplimiento.historico-component', compact('items_historico'));
    }
}
