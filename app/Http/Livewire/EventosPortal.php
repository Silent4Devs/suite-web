<?php

namespace App\Http\Livewire;

use App\Models\Empleado;
use App\Models\FelicitarCumpleaños;
use Carbon\Carbon;
use Livewire\Component;

class EventosPortal extends Component
{
    public $nuevos;
    public $cumpleaños;
    public $aniversarios;
    public $empleado_asignado;
    public $hoy;
    public $cumpleañero_id;
    public $comentario_id;

    public $comentarios;
    public $comentarios_update;

    public function mount()
    {
        $this->hoy = Carbon::now();
        $this->hoy->toDateString();

        $this->empleado_asignado = auth()->user()->n_empleado;
    }

    public function render()
    {
        $this->nuevos = Empleado::whereBetween('antiguedad', [$this->hoy->firstOfMonth()->format('Y-m-d'), $this->hoy->endOfMonth()->format('Y-m-d')])->get();

        $this->cumpleaños = Empleado::whereMonth('cumpleaños', '=', $this->hoy->format('m'))->get();

        $this->aniversarios = Empleado::whereMonth('antiguedad', '=', $this->hoy->format('m'))->get();

        // dd($nuevos);

        return view('livewire.eventos-portal');
    }

    public function felicitarCumpleaños($cumpleañero_id)
    {
        $felicitar = FelicitarCumpleaños::create([
            'cumpleañero_id' => $cumpleañero_id,
            'felicitador_id' => auth()->user()->empleado->id,
            'like' => true,
        ]);
    }

    public function felicitarCumpleañosDislike($id)
    {
        $felicitar = FelicitarCumpleaños::where('id', $id);
        $felicitar->update([
            'like' => false,
        ]);
    }

    public function felicitarCumplesComentarios($cumpleañero_id)
    {
        $this->cumpleañero_id = $cumpleañero_id;
        $comentario = FelicitarCumpleaños::create([
            'cumpleañero_id' => $this->cumpleañero_id,
            'felicitador_id' => auth()->user()->empleado->id,
            'comentarios' => $this->comentarios,
        ]);
        $this->emit('comentario-almacenado');
    }

    public function felicitarCumplesComentariosUpdate($comentario_id)
    {
        $comentario = FelicitarCumpleaños::where('id', $comentario_id);
        $comentario->update([
            'comentarios' => $this->comentarios_update,
        ]);
        $this->emit('comentario-almacenado');
    }
}
