<?php

namespace App\Http\Livewire;

use App\Models\Amenaza;
use App\Models\Vulnerabilidad;
use Livewire\Component;

class SelectVulnerabilidadComponent extends Component
{
    public $nombre;

    public $descripcion;

    public $valorAmenaza;

    protected $listeners = ['render' => 'render'];

    public function render()
    {
        $vulnerabilidades = getAll();
        $amenazas = Amenaza::get();

        return view('livewire.select-vulnerabilidad-component', compact('vulnerabilidades', 'amenazas'));
    }

    public function validarVulnerabilidad()
    {
        $this->validate([
            'nombre' => 'required|max:155',
            'descripcion' => 'required|max:255',
            'valorAmenaza' => 'required|integer',
        ]);
    }

    public function save()
    {
        $this->validarVulnerabilidad();
        $model = Vulnerabilidad::create([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'id_amenaza' => $this->valorAmenaza,
        ]);
        // dd($model);
        $this->reset('nombre', 'descripcion', 'valorAmenaza');
        $this->emit('render');
        $this->emit('cerrar-VulnerabilidadModal');
    }
}
