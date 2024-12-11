<?php

namespace App\Livewire;

use App\Models\Empleado;
use App\Models\RH\GruposEvaluado;
use Carbon\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Ev360GrupoEvaluadosCreate extends Component
{
    use LivewireAlert;

    public $open = false;

    public $empleados = [];

    public $nombreGrupo;

    protected $rules = [
        'nombreGrupo' => 'required|string|max:255',
        'empleados' => 'required',
    ];

    protected $messages = [
        'nombreGrupo.required' => 'Debes agregar un nombre para el grupo',
        'nombreGrupo.max' => 'El nombre no debe exceder los 255 carácteres',
    ];

    public function openModal()
    {
        $this->open = true;
        $this->dispatch('openModal'); // Usamos dispatch para emitir el evento
    }

    public function closeModal()
    {
        $this->open = false;
        $this->dispatch('closeModal'); // Usamos dispatch para emitir el evento
    }

    public function save()
    {
        $this->validate();
        $grupo = GruposEvaluado::create([
            'nombre' => $this->nombreGrupo,
            'created_at' => Carbon::now(),
        ]);

        $grupo->empleados()->sync($this->empleados);

        $this->alert('success', '¡Excelente! El grupo ha sido creado con éxito.');

        $this->dispatch('grupoEvaluadosSaved');
        $this->dispatch('select2');
    }

    public function render()
    {
        $lista_empleados = Empleado::getaltaAll();

        return view('livewire.ev360-grupo-evaluados-create', ['lista_empleados' => $lista_empleados]);
    }

    public function hydrate()
    {
        $this->dispatch('select2');
    }
}
