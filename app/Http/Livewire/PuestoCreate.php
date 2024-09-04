<?php

namespace App\Http\Livewire;

use App\Models\Puesto;
use Carbon\Carbon;
use Livewire\Component;

class PuestoCreate extends Component
{
    public $puesto;

    public $descripcion;

    protected $rules = [
        'puesto' => 'required|string|max:255',
        'descripcion' => 'nullable|string|max:1500',
    ];

    protected $mesages = [
        'puesto.required' => 'Debes de definir un puesto para el empleado',
        'puesto.max' => 'El puesto no debe exceder los 255 carácteres',
        'descricion.max' => 'La descripción no debe exceder los 1500 carácteres',
    ];

    public function save()
    {
        $this->validate();
        Puesto::create([
            'puesto' => $this->puesto,
            'descripcion' => $this->descripcion,
            'created_at' => Carbon::now(),
        ]);

        $this->reset(['puesto', 'descripcion']);
        $this->emit('PuestoStore');
        $this->emit('render-puesto-select');
    }

    public function render()
    {
        return view('livewire.puesto-create');
    }
}
