<?php

namespace App\Livewire;

use App\Models\Comiteseguridad;
use App\Models\Empleado;
use App\Models\FelicitarCumpleaños;
use App\Models\PoliticaSgsi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
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
    }

    public function render()
    {
        $this->empleado_asignado = User::getCurrentUser()->n_empleado;

        $hoy = Carbon::now();
        $hoy->toDateString();
        $authId = Auth::user()->id;
        $getAlta = Empleado::alta();

        $this->nuevos = Cache::remember('Portal_nuevos_'.$authId, 3600, function () use ($hoy) {
            return Empleado::whereBetween('antiguedad', [$hoy->firstOfMonth()->format('Y-m-d'), $hoy->endOfMonth()->format('Y-m-d')])->get();
        });

        $this->nuevos_contador_circulo = $this->nuevos->count();

        $this->cumpleaños = Cache::remember('Portal_cumpleaños_'.$authId, 3600, function () use ($hoy, $getAlta) {
            return $getAlta->whereMonth('cumpleaños', '=', $hoy->format('m'))->get();
        });

        $this->cumpleaños_contador_circulo = $this->cumpleaños->count();

        $this->aniversarios = Cache::remember('Portal_aniversarios_'.$authId, 3600, function () use ($hoy, $getAlta) {
            return $getAlta->whereMonth('antiguedad', '=', $hoy->format('m'))->whereYear('antiguedad', '<', $hoy->format('Y'))->get();
        });

        $this->aniversarios_contador_circulo = 0;
        foreach ($this->aniversarios as $key => $aniv) {
            if (Carbon::createFromTimeStamp(strtotime($aniv->antiguedad))->diffInYears() > 0) {
                $this->aniversarios_contador_circulo++;
            }
        }

        $this->politica_existe = PoliticaSgsi::getAll()->count();
        $this->comite_existe = Comiteseguridad::getAll()->count();

        // dd($nuevos);

        return view('livewire.eventos-portal');
    }

    public function felicitarCumpleaños($cumpleañero_id)
    {
        $felicitar = FelicitarCumpleaños::create([
            'cumpleañero_id' => $cumpleañero_id,
            'felicitador_id' => User::getCurrentUser()->empleado->id,
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
            'felicitador_id' => User::getCurrentUser()->empleado->id,
            'comentarios' => $this->comentarios,
        ]);
        $this->dispatch('comentario-almacenado');
    }

    public function felicitarCumplesComentariosUpdate($comentario_id)
    {
        $comentario = FelicitarCumpleaños::where('id', $comentario_id);
        $comentario->update([
            'comentarios' => $this->comentarios_update,
        ]);
        $this->dispatch('comentario-almacenado');
    }
}
