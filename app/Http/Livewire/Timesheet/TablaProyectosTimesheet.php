<?php

namespace App\Http\Livewire\Timesheet;

use App\Models\Area;
use App\Models\TimesheetCliente;
use App\Models\TimesheetProyecto;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class TablaProyectosTimesheet extends Component
{
    use LivewireAlert;

    public $proyectos;
    public $proyecto_name;
    public $area_id;
    public $cliente_id;

    public $proceso_count;
    public $cancelado_count;
    public $terminado_count;

    public function mount()
    {
        $this->proyectos = TimesheetProyecto::where('estatus', 'proceso')->get();
    }

    public function render()
    {
        $this->proceso_count = TimesheetProyecto::where('estatus', 'proceso')->count();
        $this->cancelado_count = TimesheetProyecto::where('estatus', 'cancelado')->count();
        $this->terminado_count = TimesheetProyecto::where('estatus', 'terminado')->count();

        $this->emit('cerrarModal');

        $this->areas = Area::get();

        $this->clientes = TimesheetCliente::get();

        return view('livewire.timesheet.tabla-proyectos-timesheet');
    }

    public function create()
    {
        $this->validate([
            'proyecto_name'=>'required',
            'area_id'=>'required',
        ]);

        if ($this->cliente_id) {
            $nuevo_proyecto = TimesheetProyecto::create([
                'proyecto' => $this->proyecto_name,
                'area_id' => $this->area_id,
                'cliente_id' => $this->cliente_id,
            ]);
        } else {
            $nuevo_proyecto = TimesheetProyecto::create([
                'proyecto' => $this->proyecto_name,
                'area_id' => $this->area_id,
            ]);
        }

        $this->alert('success', 'Registro añadido!');
    }

    public function procesos()
    {
        $this->proyectos = TimesheetProyecto::where('estatus', 'proceso')->get();
    }

    public function cancelados()
    {
        $this->proyectos = TimesheetProyecto::where('estatus', 'cancelado')->get();
    }

    public function terminados()
    {
        $this->proyectos = TimesheetProyecto::where('estatus', 'terminado')->get();
    }

    public function todos()
    {
        $this->proyectos = TimesheetProyecto::get();
    }

    public function destroy($id)
    {
        TimesheetProyecto::destroy($id);

        $this->alert('success', 'Registro eliminado!');
    }

    public function terminarProyecto($id)
    {
        $proyecto = TimesheetProyecto::find($id);
        $proyecto->update([
            'estatus'=>'terminado',
        ]);

        $this->alert('success', 'Estatus actualizado!');
    }

    public function cancelarProyecto($id)
    {
        $proyecto = TimesheetProyecto::find($id);
        $proyecto->update([
            'estatus'=>'cancelado',
        ]);

        $this->alert('success', 'Estatus actualizado!');
    }

    public function procesoProyecto($id)
    {
        $proyecto = TimesheetProyecto::find($id);
        $proyecto->update([
            'estatus'=>'proceso',
        ]);

        $this->alert('success', 'Estatus actualizado!');
    }
}
