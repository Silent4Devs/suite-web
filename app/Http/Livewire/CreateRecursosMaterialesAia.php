<?php

namespace App\Http\Livewire;

use App\Models\CuestionarioRecursosMaterialesAIA;
use Livewire\Component;

class CreateRecursosMaterialesAia extends Component
{
    public $recursoID;

    public $equipos;

    public $impresoras;

    public $telefono;

    public $otro;

    public $otro_numero;

    public $escenario;

    public $cuestionario_id;

    public $view = 'create';

    protected $listeners = ['editarMateriales' => 'edit', 'eliminarMateriales' => 'destroy'];

    public function validarMaterial()
    {
        $this->validate([
            'escenario' => 'required',
            'equipos' => 'max:999|int',
            'impresoras' => 'max:999|int',
            'telefono' => 'max:999|int',
            'otro' => 'max:245|string',
            'otro_numero' => 'max:999|int',
        ]);
    }

    public function createMateriales()
    {
        $this->default();
        $this->emit('abrir-modal-materiales');
    }

    public function saveMateriales()
    {
        $this->validarMaterial();
        $num_equipos = $this->equipos == '' ? 0 : $this->equipos;
        $num_impresoras = $this->impresoras == '' ? 0 : $this->impresoras;
        $num_telefonos = $this->telefono == '' ? 0 : $this->telefono;
        $model = CuestionarioRecursosMaterialesAIA::create([
            'escenario' => $this->escenario,
            'equipos' => $num_equipos,
            'impresoras' => $num_impresoras,
            'telefono' => $num_telefonos,
            'otro' => $this->otro,
            'cuestionario_id' => $this->cuestionario_id,
            'otro_numero' => $this->otro_numero,
        ]);

        $this->reset('id', 'escenario', 'impresoras', 'telefono', 'otro', 'equipos', 'otro_numero');
        $this->emit('render');
        $this->emit('cerrar-modal-materiales', ['editarMateriales' => false]);
    }

    public function edit($id)
    {
        $this->view = 'editMateriales';
        $model = CuestionarioRecursosMaterialesAIA::find($id);
        $this->recursoID = $model->id;
        $this->escenario = $model->escenario;
        $this->equipos = $model->equipos;
        $this->impresoras = $model->impresoras;
        $this->telefono = $model->telefono;
        $this->otro = $model->otro;
        $this->otro_numero = $model->otro_numero;

        $this->cuestionario_id = $model->cuestionario_id;
        $this->emit('abrir-modal-materiales');
    }

    public function default()
    {
        $this->escenario = '';
        $this->equipos = '';
        $this->impresoras = '';
        $this->telefono = '';
        $this->otro = '';
        $this->otro_numero = '';
        $this->view = 'create';
    }

    public function updateMateriales()
    {
        $this->validarMaterial();
        $model = CuestionarioRecursosMaterialesAIA::find($this->recursoID);
        $num_equipos = $this->equipos == '' ? 0 : $this->equipos;
        $num_impresoras = $this->impresoras == '' ? 0 : $this->impresoras;
        $num_telefonos = $this->telefono == '' ? 0 : $this->telefono;
        $model->update([
            'escenario' => $this->escenario,
            'equipos' => $num_equipos,
            'impresoras' => $num_impresoras,
            'telefono' => $num_telefonos,
            'otro' => $this->otro,
            'cuestionario_id' => $this->cuestionario_id,
            'otro_numero' => $this->otro_numero,
        ]);
        $this->emit('cerrar-modal-materiales', ['editar' => true]);
        $this->default();
        $this->emit('render');
    }

    public function destroy($id)
    {
        $model = CuestionarioRecursosMaterialesAIA::find($id);
        $model->delete();
        $this->emit('render');
    }

    public function render()
    {
        return view('livewire.create-recursos-materiales-aia');
    }
}
