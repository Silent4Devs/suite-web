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

class AnalisisBrechasIsoForm extends Component
{
    public $name;
    public $fecha;
    public $id_elaboro="";
    public $estatus="";


    public function render()
    {
        $this->fecha = Carbon::now()->format('d-m-y');
        $empleados = Empleado::getaltaAll();
        $analisis_brechas = AnalisisBrechasIso::get();
        $templates = TemplateAnalisisdeBrechas::get();
        // dd($analisis_brechas);
        return view('livewire.analisis-brechas-iso-form', compact('empleados','analisis_brechas','templates'));
    }

    private function resetInput()
    {
        $this->name = null;
        $this->id_elaboro = "";
        $this->estatus = "";
    }

    public function save()
    {
        // $analisisBrechaIso = AnalisisBrechasIso::create([
        //     'nombre' => $this->name,
        //     'fecha' => $this->fecha,
        //     'id_elaboro' => $this->id_elaboro,
        //     'estatus' => $this->estatus,
        // ]);
        // $dataCieContIso = new GenerateAnalisisBIso();
        // $datosgapunoIso = $dataCieContIso->TraerDatos($analisisBrechaIso->id);
        // GapUnoConcentratoIso::insert($datosgapunoIso);
        // $datosgapdosIso = $dataCieContIso->TraerDatosDos($analisisBrechaIso->id);
        // GapDosConcentradoIso::insert($datosgapdosIso);
        // $datosgaptresIso = $dataCieContIso->TraerDatosTres($analisisBrechaIso->id);
        // GapTresConcentradoIso::insert($datosgaptresIso);
        $this->resetInput();
        $this->emit('limpiarNameInput');
    }
}
