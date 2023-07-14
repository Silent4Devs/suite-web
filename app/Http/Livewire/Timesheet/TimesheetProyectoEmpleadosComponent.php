<?php

namespace App\Http\Livewire\Timesheet;

use App\Models\TimesheetProyecto;
use App\Models\TimesheetProyectoEmpleado;
use App\Models\TimesheetProyectoArea;
use App\Models\Empleado;
use Illuminate\Http\Request;
use Livewire\Component;
use PhpOffice\PhpSpreadsheet\Calculation\Statistical\Distributions\F;
use Jantinnerezo\LivewireAlert\LivewireAlert;

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

    public $empleado_editado;
    public $horas_edit;
    public $costo_edit;

    public function mount($proyecto_id)
    {
        $this->proyecto = TimesheetProyecto::find($proyecto_id);
        $this->areasempleado = TimesheetProyectoArea::where('proyecto_id', $proyecto_id)->get();
        $this->empleados = Empleado::getAll();
    }

    public function render()
    {
        $this->proyecto_empleados = TimesheetProyectoEmpleado::where('proyecto_id', $this->proyecto->id)->get();
        $this->emit('tablaLivewire');
        return view('livewire.timesheet.timesheet-proyecto-empleados-component');
    }

    private function resetInput()
    {
        $this->empleado_editado = null;
        $this->horas_edit = null;
        $this->costo_edit = null;
    }

    public function addEmpleado()
    {
        $empleado_add_proyecto = Empleado::find($this->empleado_añadido);
        if ($this->proyecto->tipo === "Externo") {
            $this->validate([
                'horas_asignadas' => ['required'],
                'costo_hora' => ['required'],
            ]);
        }
        $time_proyect_empleado = TimesheetProyectoEmpleado::create([
            'proyecto_id' => $this->proyecto->id,
            'empleado_id' => $empleado_add_proyecto->id,
            'area_id' => $empleado_add_proyecto->area_id,
            'horas_asignadas' => $this->horas_asignadas,
            'costo_hora' => $this->costo_hora,
        ]);
    }

    public function editEmpleado($id, Request $request)
    {
        if ($this->proyecto->tipo === "Externo") {
            $this->validate([
                'horas_edit' => ['required'],
                'costo_edit' => ['required'],
            ]);
        }
        // dd($request);
        // $empleado_añadido = $request->input('serverMemo')['data'];
        // dd($empleado_añadido);
        // $id_empleado = $empleado_añadido['empleado_editado'];
        if($this->empleado_editado != null){
            // dd($this->empleado_editado);
            $emp_upd_proyecto = Empleado::find($this->empleado_editado);
            // dd($emp_upd_proyecto);
            $empleado_edit_proyecto = TimesheetProyectoEmpleado::find($id);
            $empleado_edit_proyecto->update([
                'empleado_id' => $emp_upd_proyecto->id,
                'area_id' => $emp_upd_proyecto->area_id,
                'horas_asignadas' => $this->horas_edit,
                'costo_hora' => $this->costo_edit,
            ]);
        }else{
            // dd("Esta nulo");
            $empleado_edit_proyecto = TimesheetProyectoEmpleado::find($id);
            $empleado_edit_proyecto->update([
                'horas_asignadas' => $this->horas_edit,
                'costo_hora' => $this->costo_edit,
            ]);
        }

        $this->dispatchBrowserEvent('closeModal');
        $this->resetInput();
        $this->alert('success', 'Editado exitosamente', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'timerProgressBar' => true,
           ]);

    }

    public function empleadoProyectoRemove($id)
    {
        $empleado_remov = TimesheetProyectoEmpleado::find($id);

        $empleado_remov->delete();
    }
}
