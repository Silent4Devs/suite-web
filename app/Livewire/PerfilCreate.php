<?php

namespace App\Livewire;

use App\Models\PerfilEmpleado;
use Carbon\Carbon;
use Livewire\Component;

class PerfilCreate extends Component
{
    public $nombre;

    public $descripcion;

    protected $rules = [
        'nombre' => 'required|string|max:255',
        'descripcion' => 'nullable|string|max:1500',
    ];

    protected $mesages = [
        'nombre.required' => 'Debes de definir un nombre para el perfil',
        'nombre.max' => 'El perfil no debe exceder los 255 carácteres',
        'descricion.max' => 'La descripción no debe exceder los 1500 carácteres',
    ];

    public function save()
    {
        $this->validate();
        PerfilEmpleado::create([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'created_at' => Carbon::now(),
        ]);

        $this->reset(['nombre', 'descripcion']);
        $this->dispatch('PerfilStore');
        $this->dispatch('render-perfil-select');
        $this->emitTo('perfilSelect', 'perfilEvent');
    }

    public function render()
    {
        return view('livewire.perfil-create');
    }
}
