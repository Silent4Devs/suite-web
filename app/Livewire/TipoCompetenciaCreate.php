<?php

namespace App\Livewire;

use App\Models\RH\TipoCompetencia;
use Carbon\Carbon;
use Livewire\Component;

class TipoCompetenciaCreate extends Component
{
    public $nombre;

    public $descripcion;

    protected $rules = [
        'nombre' => 'required|string|max:255',
        'descripcion' => 'nullable|string|max:1500',
    ];

    protected $mesages = [
        'nombre.required' => 'Debes de definir un nombre para el tipo de competencia',
        'nombre.max' => 'El tipo de competencia no debe exceder los 255 carácteres',
        'descripcion.max' => 'La descripción no debe exceder los 1500 carácteres',
    ];

    public function save()
    {
        $this->validate();
        TipoCompetencia::create([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'created_at' => Carbon::now(),
        ]);
        $this->dispatch('tipoCompetenciaStore');
        $this->dispatch('render-tipo-competencia-select');
    }

    public function render()
    {
        return view('livewire.tipo-competencia-create');
    }
}
