<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ReporteIndividual extends Component
{
    public $clasificaciones;
    public $clausulas;
    public $id_auditoria;

    public function mount($clasificaciones, $clausulas, $id_auditoria)
    {
        $this->clasificaciones = $clasificaciones;
        $this->clausulas = $clausulas;
        $this->id_auditoria = $id_auditoria;
    }

    public function render()
    {
        // $clasificaciones = $this->clasificaciones;
        // $id_auditoria = $this->id_auditoria;

        return view('livewire.reporte-individual')
            ->with('clasificaciones', $this->clasificaciones)
            ->with('clausulas', $this->clausulas)
            ->with('id_auditoria', $this->id_auditoria);
    }
}
