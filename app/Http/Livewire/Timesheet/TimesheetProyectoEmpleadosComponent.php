<?php

namespace App\Http\Livewire\Timesheet;

use App\Models\Empleado;
use App\Models\TimesheetHoras;
use App\Models\TimesheetProyecto;
use App\Models\TimesheetProyectoArea;
use App\Models\TimesheetProyectoEmpleado;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class TimesheetProyectoEmpleadosComponent extends Component
{
    use LivewireAlert;

    public $proyecto;

    public $empleados;

    public $proyecto_empleados;

    public $proyecto_id;

    public $empleado_añadido;

    public $horas_asignadas;

    public $costo_hora;

    public $areasempleado;

    public function mount($proyecto_id)
    {
        $this->proyecto_id = $proyecto_id;
    }

    public function render()
    {
        $proyecto_id = $this->proyecto_id;
        $this->proyecto = TimesheetProyecto::getIdNameAll()->find($proyecto_id);
        $this->areasempleado = TimesheetProyectoArea::getAreasTimesheetProyectoEmpleados()->where('proyecto_id', $proyecto_id);
        $this->empleados = Empleado::getAltaEmpleados();

        $this->proyecto_empleados = TimesheetProyectoEmpleado::getProyectosEmpleadosTimesheetProyectosEmpleados()->where('proyecto_id', $this->proyecto->id);

        return view('livewire.timesheet.timesheet-proyecto-empleados-component');
    }

    public function hydrate()
    {
        $this->emit('scriptTabla');
    }

    private function resetInput()
    {
        $this->empleado_añadido = null;
        $this->horas_asignadas = null;
        $this->costo_hora = null;
    }

    public function addEmpleado()
    {
        $empleado_add_proyecto = Empleado::getAltaEmpleados()->find($this->empleado_añadido);
        // dd($empleado_add_proyecto);

        if ($this->proyecto->tipo == 'Externo') {

            $time_proyect_empleado = TimesheetProyectoEmpleado::firstOrCreate([
                'proyecto_id' => $this->proyecto->id,
                'empleado_id' => $empleado_add_proyecto->id,
                'area_id' => $empleado_add_proyecto->area_id,
                'horas_asignadas' => $this->horas_asignadas,
                'costo_hora' => $this->costo_hora,
            ]);
            $this->resetInput();
        }

        if($this->proyecto->tipo != 'Externo') {
            $time_proyect_empleado = TimesheetProyectoEmpleado::firstOrCreate([
                'proyecto_id' => $this->proyecto->id,
                'empleado_id' => $empleado_add_proyecto->id,
                'area_id' => $empleado_add_proyecto->area_id,
                'horas_asignadas' => 0,
                'costo_hora' => 0,
            ]);
        }

        $this->alert('success', 'Empleado agregado exitosamente', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'timerProgressBar' => true,
        ]);
    }

    public function editEmpleado($id, $datos)
    {
        if ($this->proyecto->tipo === 'Externo') {
            if (empty($datos['horas_edit']) || empty($datos['costo_edit']) || empty($datos['empleado_editado'])) {
                // dd('Llega nulo');
                // $this->dispatchBrowserEvent('closeModal');
                $this->alert('error', 'No debe contener datos vacios', [
                    'position' => 'top-end',
                    'timer' => 3000,
                    'toast' => true,
                    'timerProgressBar' => true,
                ]);

                return null;
            } else {
                $emp_upd_proyecto = Empleado::getAltaEmpleados()->find($datos['empleado_editado']);
                // dd($emp_upd_proyecto);
                $empleado_edit_proyecto = TimesheetProyectoEmpleado::find($id);
                $empleado_edit_proyecto->update([
                    'empleado_id' => $datos['empleado_editado'],
                    'area_id' => $emp_upd_proyecto->area_id,
                    'horas_asignadas' => $datos['horas_edit'],
                    'costo_hora' => $datos['costo_edit'],
                ]);
            }
        } else { //Internos
            $emp_upd_proyecto = Empleado::getAltaEmpleados()->find($datos['empleado_editado']);
            // dd($emp_upd_proyecto);
            $empleado_edit_proyecto = TimesheetProyectoEmpleado::find($id);
            $empleado_edit_proyecto->update([
                'empleado_id' => $datos['empleado_editado'],
                'area_id' => $emp_upd_proyecto->area_id,
                'horas_asignadas' => 0,
                'costo_hora' => 0,
            ]);
        }

        $this->dispatchBrowserEvent('closeModal');
        // $this->resetInput();
        $this->alert('success', 'Editado exitosamente', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'timerProgressBar' => true,
        ]);
    }

    public function bloquearEmpleado($id)
    {
        $emp_bloq = TimesheetProyectoEmpleado::find($id);

        if ($emp_bloq->usuario_bloqueado == false) {
            $emp_bloq->usuario_bloqueado = true;
            $emp_bloq->save();
            $this->alert('success', 'El Usuario ha sido Bloqueado', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'timerProgressBar' => true,
            ]);
        } elseif ($emp_bloq->usuario_bloqueado == true) {
            $emp_bloq->usuario_bloqueado = false;
            $emp_bloq->save();
            $this->alert('success', 'El Usuario ha sido Desloqueado', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'timerProgressBar' => true,
            ]);
        }
        // dd($emp_bloq->usuario_bloqueado);

    }

    public function empleadoProyectoRemove($id)
    {
        $empleado_remov = TimesheetProyectoEmpleado::find($id);

        $empleado_remov->delete();
    }
}
