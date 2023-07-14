<?php

namespace App\Http\Livewire;

use App\Models\Area;
use App\Models\AuditoriaInternasHallazgos;
use App\Models\Proceso;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class AuditoriaInternaHallazgos extends Component
{
    use LivewireAlert;

    public $incumplimiento_requisito;
    public $descripcion;
    public $clasificacion_hallazgo;
    public $auditoria_internas_id;
    public $area;
    public $proceso;
    public $hallazgoAuditoriaID;

    public $parteInteresadaIdEN;
    public $view = 'create';
    protected $listeners = ['editarParteInteresada' => 'edit', 'eliminarParteInteresada' => 'destroy', 'agregarNormas'];

    public function hydrate()
    {
        $this->emit('select2');
    }

    public function validarHallazgos()
    {
        $this->validate([
            'incumplimiento_requisito' => 'required',
            'descripcion' => 'required',
            'clasificacion_hallazgo' => 'required',
        ]);
    }

    public function create()
    {
        $this->default();
        $this->emit('abrir-modal');
    }

    public function save()
    {
        $this->validarHallazgos();
        $this->proceso = $this->proceso == '' ? null : $this->proceso;
        $this->area = $this->area == '' ? null : $this->area;
        // dd($this->proceso);
        $model = AuditoriaInternasHallazgos::create([
            'proceso_id' => $this->proceso,
            'area_id' => $this->area,
            'incumplimiento_requisito' => $this->incumplimiento_requisito,
            'clasificacion_hallazgo' => $this->clasificacion_hallazgo,
            'descripcion' => $this->descripcion,
            'auditoria_internas_id' => $this->auditoria_internas_id,
        ]);

        $this->reset('descripcion', 'incumplimiento_requisito', 'clasificacion_hallazgo', 'proceso', 'area');
        $this->emit('render');
        $this->emit('cerrar-modal', ['editar' => false]);
        $this->alert('success', 'Bien hecho', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'text' => 'Creado con éxito',
        ]);
    }

    public function edit($id)
    {
        $this->view = 'edit';
        $hallazgo = AuditoriaInternasHallazgos::find($id);
        $this->hallazgoAuditoriaID = $id;
        // dd($model);
        $this->descripcion = $hallazgo->descripcion;
        $this->clasificacion_hallazgo = $hallazgo->clasificacion_hallazgo;
        $this->proceso = $hallazgo->proceso_id;
        $this->area = $hallazgo->area_id;
        $this->incumplimiento_requisito = $hallazgo->incumplimiento_requisito;
        $this->auditoria_internas_id = $hallazgo->auditoria_internas_id;
        $this->emit('abrir-modal');
    }

    public function default()
    {
        $this->descripcion = '';
        $this->proceso = '';
        $this->area = '';
        $this->clasificacion_hallazgo = '';
        $this->incumplimiento_requisito = '';

        $this->view = 'create';
    }

    public function update()
    {
        $this->validarHallazgos();
        $model = AuditoriaInternasHallazgos::find($this->hallazgoAuditoriaID);
        $model->update([
            'proceso_id' => $this->proceso,
            'area_id' => $this->area,
            'incumplimiento_requisito' => $this->incumplimiento_requisito,
            'clasificacion_hallazgo' => $this->clasificacion_hallazgo,
            'descripcion' => $this->descripcion,
            'auditoria_internas_id' => $this->auditoria_internas_id,
        ]);

        $this->emit('cerrar-modal', ['editar' => true]);
        $this->default();
        $this->emit('render');
        $this->alert('success', 'Bien hecho', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'text' => 'Editado con éxito',
        ]);
    }

    public function destroy($id)
    {
        $model = AuditoriaInternasHallazgos::find($id);
        $model->delete();
        $this->emit('render');
        $this->alert('success', 'Bien hecho', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'text' => 'Registro eliminado',
        ]);
    }

    public function render()
    {
        $areas = Area::getAll();
        $procesos = Proceso::getAll();

        return view('livewire.auditoria-interna-hallazgos', compact('procesos', 'areas'));
    }
}
