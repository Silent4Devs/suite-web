<?php

namespace App\Http\Livewire\Visitantes;

use App\Models\Visitantes\RegistrarVisitante;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class RegistrarSalida extends Component
{
    use LivewireAlert;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $visitante;

    public $perPage = 5;

    protected $listeners = ['salidaRegistrada' => 'render'];

    public function render()
    {
        $visitantes = RegistrarVisitante::where('registro_salida', false)->paginate($this->perPage);

        return view('livewire.visitantes.registrar-salida', compact('visitantes'));
    }

    public function openModal($visitanteId)
    {
        $this->visitante = RegistrarVisitante::find($visitanteId);
        $this->emit('openModal', $this->visitante);
    }
}
