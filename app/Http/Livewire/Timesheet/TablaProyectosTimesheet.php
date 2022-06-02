<?php

namespace App\Http\Livewire\Timesheet;

use App\Models\Area;
use App\Models\Sede;
use App\Models\TimesheetCliente;
use App\Models\TimesheetProyecto;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class TablaProyectosTimesheet extends Component
{
    use LivewireAlert;

    public $proyectos;

    public $identificador;
    public $proyecto_name;
    public $area_id;
    public $cliente_id;
    public $fecha_inicio;
    public $fecha_fin;
    public $sede_id;

    public $proceso_count;
    public $cancelado_count;
    public $terminado_count;

    public $sedes;

    public function mount()
    {
        $this->proyectos = TimesheetProyecto::where('estatus', 'proceso')->orderByDesc('id')->get();
    }

    public function render()
    {
        $this->proceso_count = TimesheetProyecto::where('estatus', 'proceso')->count();
        $this->cancelado_count = TimesheetProyecto::where('estatus', 'cancelado')->count();
        $this->terminado_count = TimesheetProyecto::where('estatus', 'terminado')->count();

        $this->emit('cerrarModal');

        $this->sedes = Sede::get();

        $this->areas = Area::get();

        $this->clientes = TimesheetCliente::get();

        $this->emit('scriptTabla');

        return view('livewire.timesheet.tabla-proyectos-timesheet');
    }

    public function store()
    {
        $this->validate(
            [
                'identificador' => 'required|unique:timesheet_proyectos,identificador',
                'proyecto_name'=>'required',
                'area_id'=>'required',
            ],
            [
                'identificador.unique' => 'El ID ya esta en uso',
            ],
        );

        $nuevo_proyecto = TimesheetProyecto::create([
            'identificador' => $this->identificador,
            'proyecto' => $this->proyecto_name,
            'area_id' => $this->area_id,
            'cliente_id' => $this->cliente_id,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
            'sede_id' => $this->sede_id,
        ]);

        $this->identificador = null;
        $this->proyecto_name = null;
        $this->area_id = null;
        $this->cliente_id = null;
        $this->fecha_inicio = null;
        $this->fecha_fin = null;
        $this->sede_id = null;

        $this->proyectos = TimesheetProyecto::where('estatus', 'proceso')->orderByDesc('id')->get();

        $this->alert('success', 'Registro añadido!');
    }

    public function procesos()
    {
        $this->proyectos = TimesheetProyecto::where('estatus', 'proceso')->orderByDesc('id')->get();
    }

    public function cancelados()
    {
        $this->proyectos = TimesheetProyecto::where('estatus', 'cancelado')->orderByDesc('id')->get();
    }

    public function terminados()
    {
        $this->proyectos = TimesheetProyecto::where('estatus', 'terminado')->orderByDesc('id')->get();
    }

    public function todos()
    {
        $this->proyectos = TimesheetProyecto::orderByDesc('id')->get();
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
