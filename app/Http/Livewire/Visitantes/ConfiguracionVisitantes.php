<?php

namespace App\Http\Livewire\Visitantes;

use App\Models\Empleado;
use App\Models\Visitantes\ResponsableVisitantes;
use Livewire\Component;

class ConfiguracionVisitantes extends Component
{
    public $empleados;
    public $responsable = "";
    public $responsableVisitante;
    public $fotografiaRequerida = false;

    protected $rules = [
        'responsable' => 'required|numeric'
    ];

    public function hydrate()
    {
        $this->emit('select2');
    }

    public function mount()
    {

        $this->empleados = Empleado::select('id', 'name')->orderBy('name')->get();
    }

    public function render()
    {
        $this->responsableVisitante = ResponsableVisitantes::first();

        if ($this->responsableVisitante != null) {
            $this->responsable = $this->responsableVisitante->empleado_id;
            $this->fotografiaRequerida = $this->responsableVisitante->fotografia_requerida;
        }
        return view('livewire.visitantes.configuracion-visitantes');
    }

    public function updatedResponsable($value)
    {
        ResponsableVisitantes::updateOrCreate(
            ['id' => ResponsableVisitantes::first()->id ?? 1],
            ['empleado_id' => $value]
        );
    }

    public function updatedfotografiaRequerida($value)
    {
        $value = $value == 'true' ? true : false;
        ResponsableVisitantes::updateOrCreate(
            ['id' => ResponsableVisitantes::first()->id ?? 1],
            ['fotografia_requerida' => $value]
        );
    }
}
