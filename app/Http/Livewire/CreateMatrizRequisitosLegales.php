<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CreateMatrizRequisitosLegales extends Component
{
    public function render()
    {
        return view('livewire.create-matriz-requisitos-legales');
    }

    public $alcance_s1 = [1];

    public function addAlcance1()
    {
        $this->alcance_s1[] = '';
    }

    public function test()
    {
        dd('hola');
    }

    public function removeAlcance1($index)
    {
        // dd($index);
        unset($this->alcances_s1[$index]);
        $this->alcance_s1 = array_values($this->alcances_s1);
    }
}
