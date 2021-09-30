<?php

namespace App\Http\Livewire;

use App\Models\RH\TipoObjetivo;
use Carbon\Carbon;
use Livewire\Component;

class TipoObjetivosCreate extends Component
{
    public $nombre;
    protected $rules = [
        'nombre' => 'required|string|max:255',
    ];

    protected $mesages = [
        'nombre.required' => 'Debes de definir un nombre para el tipo de objetivo',
        'nombre.max' => 'El tipo de objetivo no debe exceder los 255 carácteres',
    ];

    public function save()
    {
        $this->validate();
        TipoObjetivo::create([
            'nombre' => $this->nombre,
            'created_at' => Carbon::now(),
        ]);
        $this->emit('tipoObjetivoStore');
        $this->emit('render-tipo-objetivo-select');
    }

    public function render()
    {
        return view('livewire.tipo-objetivos-create');
    }
}
