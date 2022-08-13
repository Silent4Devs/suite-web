<?php

namespace App\Http\Livewire\Visitantes;

use App\Models\Visitantes\RegistrarVisitante;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class RegistrarSalida extends Component
{
    use LivewireAlert;

    public $visitantes;
    public $visitante;
    public $firma;


    public function mount()
    {
        $this->visitantes = RegistrarVisitante::where('registro_salida', false)->get();
        $this->visitante = null;
    }

    public function render()
    {
        return view('livewire.visitantes.registrar-salida');
    }

    public function openModal($visitanteId)
    {
        $this->visitante = RegistrarVisitante::find($visitanteId);
        $this->emit('openModal');
    }

    public function limpiarFirma()
    {
        dd('limpiar firma');
    }

    public function registrarSalida()
    {
        $registroVisitante = RegistrarVisitante::find($this->visitante->id);
        $registroVisitante->update([
            'firma' => $this->firma,
            'registro_salida' => true,
        ]);
        $this->alert('success', 'Bien Hecho ' . $registroVisitante->nombre . ', has registrado tu salida correctamente', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
        ]);
        $this->visitantes = RegistrarVisitante::where('registro_salida', false)->get();
        $this->emit('closeModal');
    }
}
