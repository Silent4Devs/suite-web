<?php

namespace App\Http\Livewire;

use App\Models\Empleado;
use App\Models\PlanAuditoriaActividades;
use Carbon\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class PlanAuditoriaActividadesComponent extends Component
{
    use LivewireAlert;

    public $actividad_auditar;

    public $fecha_auditoria;

    public $horario_inicio;

    public $horario_termino;

    public $nombre_auditor;

    public $auditado;

    public $plan_auditoria_id;

    public $actividadID;

    public $parteInteresadaIdEN;

    public $view = 'create';

    protected $listeners = ['editarParteInteresada' => 'edit', 'eliminarParteInteresada' => 'destroy', 'agregarNormas'];

    public function hydrate()
    {
        $this->emit('select2');
    }

    public function validarActividades()
    {
        $this->validate([
            'actividad_auditar' => 'required',
            'nombre_auditor' => 'required',
            'fecha_auditoria' => 'required|date',
            'auditado' => 'required',
        ]);
    }

    public function create()
    {
        $this->default();
        $this->emit('abrir-modal');
    }

    public function save()
    {
        $this->validarActividades();
        $model = PlanAuditoriaActividades::create([
            'id_auditado' => $this->auditado,
            'nombre_auditor' => $this->nombre_auditor,
            'horario_termino' => $this->horario_termino,
            'horario_inicio' => $this->horario_inicio,
            'fecha_auditoria' => $this->fecha_auditoria,
            'actividad_auditar' => $this->actividad_auditar,
            'plan_auditoria_id' => $this->plan_auditoria_id,
        ]);

        $this->reset('nombre_auditor', 'horario_termino', 'horario_inicio', 'fecha_auditoria', 'actividad_auditar');
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
        $plan = PlanAuditoriaActividades::find($id);
        $this->actividadID = $id;
        // dd($model);
        $this->actividad_auditar = $plan->actividad_auditar;
        $this->fecha_auditoria = Carbon::parse($plan->fecha_auditoria)->format('Y-m-d');
        $this->auditado = $plan->id_auditado;
        $this->nombre_auditor = $plan->nombre_auditor;
        $this->horario_inicio = $plan->horario_inicio;
        $this->horario_termino = $plan->horario_termino;
        $this->plan_auditoria_id = $plan->plan_auditoria_id;
        $this->emit('abrir-modal');
        $this->emit('cargar-puesto', $id);
    }

    public function default()
    {
        $this->actividad_auditar = '';
        $this->auditado = '';
        $this->nombre_auditor = '';
        $this->horario_inicio = '';
        $this->horario_termino = '';
        $this->fecha_auditoria = '';

        $this->view = 'create';
    }

    public function update()
    {
        $this->validarActividades();
        $model = PlanAuditoriaActividades::find($this->actividadID);
        $model->update([
            'actividad_auditar' => $this->actividad_auditar,
            'fecha_auditoria' => $this->fecha_auditoria,
            'horario_inicio' => $this->horario_inicio,
            'horario_termino' => $this->horario_termino,
            'nombre_auditor' => $this->nombre_auditor,
            'id_auditado' => $this->auditado,
            'plan_auditoria_id' => $this->plan_auditoria_id,
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
        $model = PlanAuditoriaActividades::find($id);
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
        $empleados = Empleado::getAltaEmpleadosWithArea();

        return view('livewire.plan-auditoria-actividades-component', compact('empleados'));
    }
}
