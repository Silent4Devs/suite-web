<?php

namespace App\Http\Livewire;

use App\Functions\GenerateAnalisisBIso;
use App\Models\Empleado;
use App\Models\Iso27\AnalisisBrechasIso;
use App\Models\Iso27\GapDosConcentradoIso;
use App\Models\Iso27\GapTresConcentradoIso;
use App\Models\Iso27\GapUnoConcentratoIso;
use App\Models\Norma;
use App\Models\TemplateAnalisisdeBrechas;

class AnalisisBrechasIsoForm extends Component
{
    public $analisis_id;

    public $name;

    public $fecha;

    public $id_elaboro = '';

    public $norma = 'iso27001';

    private $norma_id = 1;

    public $selectedCard = null;

    public $view = 'create';

    protected $listeners = ['destroy'];

    public function mount()
    {
        $this->fecha = Carbon::now()->format('d-m-y');
    }

    public function render()
    {
        $empleados = Empleado::getaltaAll();
        $analisis_brechas = AnalisisBrechasIso::get();
        $templates = TemplateAnalisisdeBrechas::where('top', true)->get();
        // dd($templates);
        $normas = Norma::get();

        return view('livewire.analisis-brechas-iso-form', compact('empleados', 'analisis_brechas', 'templates', 'normas'));
    }

    private function resetInput()
    {
        $this->name = null;
        $this->id_elaboro = '';
        $this->estatus = '';
    }

    public function save()
    {
        if ($this->selectedCard) {
            $analisisBrechaIso = AnalisisBrechasIso::create([
                'nombre' => $this->name,
                'fecha' => $this->fecha,
                'id_elaboro' => $this->id_elaboro,
                'estatus' => 1,
                'norma_id' => $this->norma_id,
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
        dd('afuera');

    }

    public function SelectCard($index)
    {
        if ($this->selectedCard === $index) {
            $this->selectedCard = null;
        } else {
            $this->selectedCard = $index;

        }
    }

    public function edit($id)
    {
        $analisis_brechas = AnalisisBrechasIso::find($id);
        $this->name = $analisis_brechas->nombre;
        $fecha = strtotime($analisis_brechas->fecha);
        $this->fecha = date('d-m-y', $fecha);
        $this->id_elaboro = $analisis_brechas->empleado->id;
        $this->view = 'edit';
        $this->analisis_id = $id;

    }

    public function update()
    {
        $analisis_brechas = AnalisisBrechasIso::find($this->analisis_id);
        $analisis_brechas->update([
            'nombre' => $this->name,
            'fecha' => $this->fecha,
            'id_elaboro' => $this->id_elaboro,
        ]);
    }

    public function destroy($id)
    {
        AnalisisBrechasIso::destroy($id);
    }
}
