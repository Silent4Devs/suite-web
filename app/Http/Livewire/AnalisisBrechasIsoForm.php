<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Empleado;
use Carbon\Carbon;
use App\Models\Iso27\AnalisisBrechasIso;
use App\Functions\GenerateAnalisisBIso;
use App\Models\Iso27\GapDosConcentradoIso;
use App\Models\Iso27\GapTresConcentradoIso;
use App\Models\Iso27\GapUnoConcentratoIso;
use App\Models\TemplateAnalisisdeBrechas;
use App\Models\Norma;

class AnalisisBrechasIsoForm extends Component
{
    public $name;
    public $fecha;
    public $id_elaboro="";

    public $norma =1;
    public $selectedCard = null;


    public function render()
    {
        $this->fecha = Carbon::now()->format('d-m-y');
        $empleados = Empleado::getaltaAll();
        $analisis_brechas = AnalisisBrechasIso::get();
        $templates = TemplateAnalisisdeBrechas::get();
        $normas = Norma::get();
        // dd($normas);
        return view('livewire.analisis-brechas-iso-form', compact('empleados','analisis_brechas','templates', "normas"));
    }

    private function resetInput()
    {
        $this->name = null;
        $this->id_elaboro = "";
        $this->estatus = "";
    }

    public function save()
    {
        $analisisBrechaIso = AnalisisBrechasIso::create([
            'nombre' => $this->name,
            'fecha' => $this->fecha,
            'id_elaboro' => $this->id_elaboro,
            'estatus' => 1,
            'norma_id' => $this->norma,
        ]);
        $dataCieContIso = new GenerateAnalisisBIso();
        $datosgapunoIso = $dataCieContIso->TraerDatos($analisisBrechaIso->id);
        GapUnoConcentratoIso::insert($datosgapunoIso);
        $datosgapdosIso = $dataCieContIso->TraerDatosDos($analisisBrechaIso->id);
        GapDosConcentradoIso::insert($datosgapdosIso);
        $datosgaptresIso = $dataCieContIso->TraerDatosTres($analisisBrechaIso->id);
        GapTresConcentradoIso::insert($datosgaptresIso);
        $this->resetInput();
        $this->emit('limpiarNameInput');
    }

    public function SelectCard($index)
    {
        // dd($index);
        if ($this->selectedCard === $index) {
            $this->selectedCard = null;
        } else {
            $this->selectedCard = $index;
        }
    }
}
