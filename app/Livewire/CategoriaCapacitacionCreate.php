<?php

namespace App\Livewire;

use App\Models\CategoriaCapacitacion;
use Carbon\Carbon;
use Livewire\Component;

class CategoriaCapacitacionCreate extends Component
{
    public $nombre;

    protected $rules = [
        'nombre' => 'required|string|unique:categoria_capacitacions,nombre|max:255',
    ];

    protected $mesages = [
        'nombre.required' => 'Debes de definir un nombre para la categoría',
        'nombre.unique' => 'Este nombre ya ha sido tomado',
    ];

    public function save()
    {
        $this->validate();
        CategoriaCapacitacion::create([
            'nombre' => $this->nombre,
            'created_at' => Carbon::now(),
        ]);
        $this->dispatch('categoriaCapacitacionStore');
        $this->dispatch('render-categorias-capacitacion-select');
    }

    public function render()
    {
        return view('livewire.categoria-capacitacion-create');
    }
}
