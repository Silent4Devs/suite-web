<?php

namespace App\Http\Livewire;

use App\Models\ObjetivosDesempenoEmpleados;
use Livewire\Component;

class PapeleraObjetivosDesempeno extends Component
{
    public $objetivos;

    public function render()
    {
        $this->objetivos = ObjetivosDesempenoEmpleados::with('categoria', 'unidad')
            ->where('empleado_id', $this->id_emp)
            ->where('papelera', true)
            ->get();

        return view('livewire.papelera-objetivos-desempeno');
    }

    public function restaurarPapelera($id_obj)
    {
        $objetivo = ObjetivosDesempenoEmpleados::find($id_obj);

        $objetivo->update([
            'papelera' => false
        ]);
    }

    public function eliminarObjetivo($id_obj)
    {
        $objetivo = ObjetivosDesempenoEmpleados::find($id_obj);

        $objetivo->delete();
    }
}
