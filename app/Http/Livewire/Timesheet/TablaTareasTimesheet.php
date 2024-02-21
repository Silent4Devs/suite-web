<?php

namespace App\Http\Livewire\Timesheet;

use App\Models\TimesheetProyecto;
use App\Models\TimesheetTarea;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class TablaTareasTimesheet extends Component
{
    use LivewireAlert;

    public $tareas;

    public $proyectos;

    public $proyecto_seleccionado;

    public $tarea_name;

    public $area_select;

    public $proyecto_id;

    public $origen;

    public $tareas_proyecto;

    public $area_seleccionar;

    public $proyecto_filtro;

    public $tarea_name_actualizada;

    public function hydrate()
    {
        $this->emit('select2');
        $this->emit('scriptTabla');
    }

    public function mount($proyecto_id, $origen)
    {
        $this->origen = $origen;
        $this->proyecto_id = $proyecto_id;
        $this->area_seleccionar = null;
    }

    public function updateProyecto($value)
    {
        $this->proyecto_filtro = $value;

        $this->emit('updateProyecto');
    }

    public function render()
    {
        if ($this->origen == 'tareas') {
            // Eager load projects with their tasks
            $this->proyectos = TimesheetProyecto::getAllWithData();

            if ($this->proyecto_filtro) {
                // Filter tasks by project if a project filter is applied
                $this->tareas = $this->proyectos->firstWhere('id', $this->proyecto_filtro)->tareas;
            } else {
                // Otherwise, fetch all tasks
                $this->tareas = TimesheetTarea::getIdTareasAll();
            }
        }

        if ($this->origen == 'tareas-proyectos') {
            // Fetch the selected project along with its tasks
            $this->proyecto_seleccionado = TimesheetProyecto::with('tareas:id,tarea,proyecto_id,area_id,todos')
                ->find($this->proyecto_id);
            // Assign tasks directly
            $this->tareas = $this->proyecto_seleccionado->tareas;
            // Assign selected area
            $this->area_seleccionar = $this->proyecto_seleccionado->areas;
        }

        return view('livewire.timesheet.tabla-tareas-timesheet');
    }

    public function create()
    {
        if ($this->area_select === 0) {
            $area_id = null;
            $todos = true;
        } else {
            $area_id = $this->area_select;
            $todos = false;
        }
        if ($this->origen == 'tareas') {
            $proyecto_procesado = $this->proyecto_id;
        } else {
            $proyecto_procesado = $this->proyecto_seleccionado->id;
        }

        if (empty($this->tarea_name)) {

            return view('livewire.timesheet.tabla-tareas-timesheet')->with('error', 'Tarea nula. Intentelo de nuevo.');
        }

        $nueva_tarea = TimesheetTarea::create([
            'tarea' => $this->tarea_name,
            'proyecto_id' => $proyecto_procesado,
            'area_id' => $area_id,
            'todos' => $todos,
        ]);

        $this->emit('tarea-actualizada', $nueva_tarea);

        $this->alert('success', 'Registro añadido!');
    }

    public function actualizarNameTarea($id, $value)
    {
        $tarea_actualizada = TimesheetTarea::select(
            'id',
            'tarea',
            'proyecto_id',
            'area_id',
            'todos'
        )->find($id);

        $tarea_actualizada->update([
            'tarea' => $value,
        ]);

        $this->emit('tarea-actualizada', $tarea_actualizada);
    }

    public function actualizarAreaTarea($id, $value)
    {
        $tarea_actualizada = TimesheetTarea::select(
            'id',
            'tarea',
            'proyecto_id',
            'area_id',
            'todos',
        )->find($id);

        if ($value == 0) {
            $area_id = null;
            $todos = true;
        } else {
            $area_id = $value;
            $todos = false;
        }

        $tarea_actualizada->update([
            'area_id' => $area_id,
            'todos' => $todos,
        ]);

        $this->emit('tarea-actualizada', $tarea_actualizada);
    }

    public function llenarAreas($id)
    {
        if ($id) {
            $this->proyecto_seleccionado = TimesheetProyecto::find($id);
            $this->area_seleccionar = $this->proyecto_seleccionado->areas;
        } else {
            $this->area_seleccionar = [];
        }
    }

    public function destroy($id)
    {
        TimesheetTarea::destroy($id);

        $this->alert('success', 'Registro eliminado!');
    }
}
