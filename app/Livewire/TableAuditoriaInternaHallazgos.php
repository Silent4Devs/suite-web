<?php

namespace App\Livewire;

use App\Models\AuditoriaInternasHallazgos;
use Livewire\Component;

class TableAuditoriaInternaHallazgos extends Component
{
    public $auditoria_internas_id;

    protected $listeners = ['render' => 'render'];

    public function render()
    {
        $datas = AuditoriaInternasHallazgos::where('auditoria_internas_id', '=', $this->auditoria_internas_id)->get();

        return view('livewire.table-auditoria-interna-hallazgos', compact('datas'));
    }
}
