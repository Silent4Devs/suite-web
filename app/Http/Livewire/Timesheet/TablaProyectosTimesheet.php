<?php

namespace App\Http\Livewire\Timesheet;

use App\Models\Area;
use App\Models\Sede;
use App\Models\TimesheetCliente;
use App\Models\TimesheetProyecto;
use App\Models\TimesheetProyectoArea;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class TablaProyectosTimesheet extends Component
{
    use LivewireAlert;

    public $proyectos;

    public $identificador;

    public $proyecto_name;

    public $areas_seleccionadas;

    public $cliente_id;

    public $fecha_inicio;

    public $fecha_fin;

    public $sede_id;

    public $tipo;

    public $proceso_count;

    public $cancelado_count;

    public $terminado_count;

    public $tipos;

    public $sedes;

    public $areas;

    public function mount()
    {
        $this->tipos = TimesheetProyecto::TIPOS;
        $this->tipo = $this->tipos['Interno'];
        $this->proyectos = TimesheetProyecto::where('estatus', 'proceso')
        ->orderBy('identificador')->get()->sortBy('identificador', SORT_NATURAL);
    }

    public function render()
    {
        $this->proceso_count = TimesheetProyecto::where('estatus', 'proceso')->count();
        $this->cancelado_count = TimesheetProyecto::where('estatus', 'cancelado')->count();
        $this->terminado_count = TimesheetProyecto::where('estatus', 'terminado')->count();

        $this->emit('cerrarModal');

        $this->sedes = Sede::getAll();

        $this->areas = Area::getAll();

        $this->clientes = TimesheetCliente::orderBy('nombre')->get();

        $this->emit('scriptTabla');

        return view('livewire.timesheet.tabla-proyectos-timesheet');
    }

    public function store()
    {
        $this->validate(
            [
                'identificador' => 'required|unique:timesheet_proyectos,identificador',
                'proyecto_name' => 'required',
            ],
            [
                'identificador.unique' => 'El ID ya esta en uso',
            ],
        );
        if ($this->fecha_inicio && $this->fecha_fin) {
            $this->validate(
                [
                    'fecha_inicio' => 'before:fecha_fin',
                    'fecha_fin' => 'after:fecha_inicio',
                ],
                [
                    'fecha_inicio.before' => 'La fecha de incio debe ser anterior a la fecha de fin',
                    'fecha_fin.after' => 'La fecha de fin debe ser posterior a la fecha de incio',
                ],
            );
        }
        $nuevo_proyecto = TimesheetProyecto::create([
            'identificador' => $this->identificador,
            'proyecto' => $this->proyecto_name,
            'cliente_id' => $this->cliente_id,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
            'sede_id' => $this->sede_id,
            'tipo' => $this->tipo,
        ]);

        foreach ($this->areas_seleccionadas as $key => $area_id) {
            TimesheetProyectoArea::create([
                'proyecto_id' => $nuevo_proyecto->id,
                'area_id' => $area_id,
            ]);
        }

        $this->procesos();

        $this->alert('success', 'Registro añadido!');
    }

    public function procesos()
    {
        $this->proyectos = TimesheetProyecto::where('estatus', 'proceso')
        ->orderBy('identificador')->get()->sortBy('identificador', SORT_NATURAL);
    }

    public function cancelados()
    {
        $this->proyectos = TimesheetProyecto::where('estatus', 'cancelado')
        ->orderBy('identificador')->get()->sortBy('identificador', SORT_NATURAL);    }

    public function terminados()
    {
        $this->proyectos = TimesheetProyecto::where('estatus', 'terminado')
        ->orderBy('identificador')->get()->sortBy('identificador', SORT_NATURAL);;
    }

    public function todos()
    {
        $this->proyectos = TimesheetProyecto::orderBy('identificador')
        ->get()->sortBy('identificador', SORT_NATURAL);
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
            'estatus' => 'terminado',
        ]);

        $this->alert('success', 'Estatus actualizado!');
    }

    public function cancelarProyecto($id)
    {
        $proyecto = TimesheetProyecto::find($id);
        $proyecto->update([
            'estatus' => 'cancelado',
        ]);

        $this->alert('success', 'Estatus actualizado!');
    }

    public function procesoProyecto($id)
    {
        $proyecto = TimesheetProyecto::find($id);
        $proyecto->update([
            'estatus' => 'proceso',
        ]);

        $this->alert('success', 'Estatus actualizado!');
    }
}
