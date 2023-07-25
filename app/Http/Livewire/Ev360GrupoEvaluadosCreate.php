<?php

namespace App\Http\Livewire;

use App\Models\Empleado;
use App\Models\RH\GruposEvaluado;
use Carbon\Carbon;
use Livewire\Component;

class Ev360GrupoEvaluadosCreate extends Component
{
    public $open = false;

    public $empleados = [];

    public $nombreGrupo;

    protected $rules = [
        'nombreGrupo' => 'required|string|max:255',
        'empleados' => 'required',
    ];

    protected $mesages = [
        'nombreGrupo.required' => 'Debes agregar un nombre para el grupo',
        'nombreGrupo.max' => 'El nombre no debe exceder los 255 carácteres',
    ];

    public function openModal()
    {
        $this->emit('openModalClick');
    }

    public function save()
    {
        $this->validate();
        $grupo = GruposEvaluado::create([
            'nombre' => $this->nombreGrupo,
            'created_at' => Carbon::now(),
        ]);

        $grupo->empleados()->sync($this->empleados);

        $this->emit('grupoEvaluadosSaved');
        $this->emit('select2');
    }

    public function render()
    {
        $lista_empleados = Empleado::getaltaAll();

        return view('livewire.ev360-grupo-evaluados-create', ['lista_empleados' => $lista_empleados]);
    }

    public function hydrate()
    {
        $this->emit('select2');
    }
}
