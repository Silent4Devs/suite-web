<?php

namespace App\Livewire;

use App\Models\RH\ObjetivoEmpleado;
use Livewire\Component;

class PapeleraObjetivosDesempeno extends Component
{
    public $id_emp;

    public $objetivos;

    public function mount($id_empleado)
    {
        $this->id_emp = $id_empleado;
    }

    public function render()
    {
        $this->objetivos = ObjetivoEmpleado::getAllwithObjetivo()
            ->where('empleado_id', '=', $this->id_emp)
            ->where('papelera', true);

        return view('livewire.papelera-objetivos-desempeno');
    }

    public function restaurarPapelera($id_obj)
    {
        $objetivo = ObjetivoEmpleado::find($id_obj);
        // dd($objetivo);
        $objetivo->update([
            'papelera' => false,
        ]);
    }

    public function eliminarObjetivo($id_obj)
    {
        $objetivo = ObjetivoEmpleado::find($id_obj);

        $objetivo->delete();
    }
}
