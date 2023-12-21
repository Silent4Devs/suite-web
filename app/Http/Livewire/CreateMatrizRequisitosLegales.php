<?php

namespace App\Http\Livewire;

use App\Models\MatrizRequisitoLegale;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateMatrizRequisitosLegales extends Component
{
    public collection $alcance_s1;

    public $alcance;

    public $bandera = true;

    public $bandera2 = false;

    protected $listeners = [
        'renderMatriz' => 'render',
    ];

    public function mount()
    {
        $this->alcance_s1 = new Collection();
    }

    public function render()
    {
        return view('livewire.create-matriz-requisitos-legales');
    }

    public function addAlcance1()
    {
        $this->alcance_s1->push([
            'nombrerequisito' => '',
        ]);
        $this->emit('renderMatriz');

        $this->bandera = false;
        $this->bandera2 = false;
    }

    public function removeAlcance1($index)
    {
        unset($this->alcance_s1[$index]);
        $this->bandera = true;
    }

    public function save()
    {
        // dd($this->alcance, $this->alcance_s1);
        DB::beginTransaction();
        try {
            MatrizRequisitoLegale::create([
                'nombrerequisito' => $this->alcance['nombrerequisito'],
                'formacumple' => $this->alcance['formacumple'],
                'fechaexpedicion' => $this->alcance['fechaexpedicion'],
                'fechavigor' => $this->alcance['fechavigor'],
                'requisitoacumplir' => $this->alcance['requisitoacumplir'],
            ]);
            foreach ($this->alcance_s1 as $alcance1) {
                MatrizRequisitoLegale::create([
                    'nombrerequisito' => $alcance1['nombrerequisito'],
                    'formacumple' => $alcance1['formacumple'],
                    'fechaexpedicion' => $alcance1['fechaexpedicion'],
                    'fechavigor' => $alcance1['fechavigor'],
                    'requisitoacumplir' => $alcance1['requisitoacumplir'],
                ]);
            }
            DB::commit();

            return redirect()->route('admin.matriz-requisito-legales.index');
        } catch (\Throwable $th) {
            DB::rollback();
        }
    }
}
