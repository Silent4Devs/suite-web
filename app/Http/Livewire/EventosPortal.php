<?php

namespace App\Http\Livewire;

use App\Models\Comiteseguridad;
use App\Models\Empleado;
use App\Models\FelicitarCumpleaños;
use App\Models\PoliticaSgsi;
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

    public $nuevos_contador_circulo;

    public $cumpleaños_contador_circulo;

    public $aniversarios_contador_circulo;

    public $politica_existe;

    public $comite_existe;

    public function mount()
    {
        $this->hoy = Carbon::now();
        $this->hoy->toDateString();

        $this->empleado_asignado = auth()->user()->n_empleado;
    }

    public function render()
    {
        $this->nuevos = Empleado::getaltaAll()->whereBetween('antiguedad', [$this->hoy->firstOfMonth()->format('Y-m-d'), $this->hoy->endOfMonth()->format('Y-m-d')])->get();
        $this->nuevos_contador_circulo = Empleado::getaltaAll()->whereBetween('antiguedad', [$this->hoy->firstOfMonth()->format('Y-m-d'), $this->hoy->endOfMonth()->format('Y-m-d')])->count();

        $this->cumpleaños = Empleado::getaltaAll()->whereMonth('cumpleaños', '=', $this->hoy->format('m'))->get();
        $this->cumpleaños_contador_circulo = Empleado::getaltaAll()->whereMonth('cumpleaños', '=', $this->hoy->format('m'))->count();

        $this->aniversarios = Empleado::getaltaAll()->whereMonth('antiguedad', '=', $this->hoy->format('m'))->whereYear('antiguedad', '<', $this->hoy->format('Y'))->get();
        $this->aniversarios_contador_circulo = 0;
        foreach ($this->aniversarios as $key => $aniv) {
            if (Carbon::createFromTimeStamp(strtotime($aniv->antiguedad))->diffInYears() > 0) {
                $this->aniversarios_contador_circulo++;
            }
        }

        $this->politica_existe = PoliticaSgsi::count();
        $this->comite_existe = Comiteseguridad::count();

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
