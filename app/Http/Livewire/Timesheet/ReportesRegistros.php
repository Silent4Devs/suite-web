<?php

namespace App\Http\Livewire\Timesheet;

use App\Models\Area;
use App\Models\Timesheet;
use Livewire\Component;

class ReportesRegistros extends Component
{
    public $todos_contador;
    public $borrador_contador;
    public $pendientes_contador;
    public $aprobados_contador;
    public $rechazos_contador;
    public $times;
    public $areas;
    public $area_id = 0;

    public $fecha_inicio;
    public $fecha_fin;

    public function mount()
    {
        $this->times = Timesheet::orderByDesc('fecha_dia')->get();
        $this->areas = Area::get();
    }

    public function updatedFechaInicio($value)
    {
        $this->fecha_inicio = $value;
        $this->times = Timesheet::whereHas('empleado', function ($query) {
            if ($this->area_id == 0) {
                return $query;
            } else {
                $query->where('area_id', $this->area_id);
            }
        })->where('fecha_dia', '>=', $this->fecha_inicio ? $this->fecha_inicio : '1900-01-01')->where('fecha_dia', '<=', $this->fecha_fin ? $this->fecha_fin : now()->format('Y-m-d'))->orderByDesc('fecha_dia')->get();
    }

    public function updatedFechaFin($value)
    {
        $this->fecha_fin = $value;
        $this->times = Timesheet::whereHas('empleado', function ($query) {
            if ($this->area_id == 0) {
                return $query;
            } else {
                $query->where('area_id', $this->area_id);
            }
        })->where('fecha_dia', '>=', $this->fecha_inicio ? $this->fecha_inicio : '1900-01-01')->where('fecha_dia', '<=', $this->fecha_fin ? $this->fecha_fin : now()->format('Y-m-d'))->orderByDesc('fecha_dia')->get();
    }

    public function updatedAreaId($value)
    {
        $this->area_id = $value;

        $this->times = Timesheet::whereHas('empleado', function ($query) {
            if ($this->area_id == 0) {
                return $query;
            } else {
                $query->where('area_id', $this->area_id);
            }
        })->where('fecha_dia', '>=', $this->fecha_inicio ? $this->fecha_inicio : '1900-01-01')->where('fecha_dia', '<=', $this->fecha_fin ? $this->fecha_fin : now()->format('Y-m-d'))->orderByDesc('fecha_dia')->get();
    }

    public function render()
    {
        $this->todos_contador = Timesheet::whereHas('empleado', function ($query) {
            if ($this->area_id == 0) {
                return $query;
            } else {
                $query->where('area_id', $this->area_id);
            }
        })->where('fecha_dia', '>=', $this->fecha_inicio ? $this->fecha_inicio : '1900-01-01')->where('fecha_dia', '<=', $this->fecha_fin ? $this->fecha_fin : now()->format('Y-m-d'))->count();
        $this->borrador_contador = Timesheet::whereHas('empleado', function ($query) {
            if ($this->area_id == 0) {
                return $query;
            } else {
                $query->where('area_id', $this->area_id);
            }
        })->where('fecha_dia', '>=', $this->fecha_inicio ? $this->fecha_inicio : '1900-01-01')->where('fecha_dia', '<=', $this->fecha_fin ? $this->fecha_fin : now()->format('Y-m-d'))->where('estatus', 'papelera')->count();
        $this->pendientes_contador = Timesheet::whereHas('empleado', function ($query) {
            if ($this->area_id == 0) {
                return $query;
            } else {
                $query->where('area_id', $this->area_id);
            }
        })->where('fecha_dia', '>=', $this->fecha_inicio ? $this->fecha_inicio : '1900-01-01')->where('fecha_dia', '<=', $this->fecha_fin ? $this->fecha_fin : now()->format('Y-m-d'))->where('estatus', 'pendiente')->count();
        $this->aprobados_contador = Timesheet::whereHas('empleado', function ($query) {
            if ($this->area_id == 0) {
                return $query;
            } else {
                $query->where('area_id', $this->area_id);
            }
        })->where('fecha_dia', '>=', $this->fecha_inicio ? $this->fecha_inicio : '1900-01-01')->where('fecha_dia', '<=', $this->fecha_fin ? $this->fecha_fin : now()->format('Y-m-d'))->where('estatus', 'aprobado')->count();
        $this->rechazos_contador = Timesheet::whereHas('empleado', function ($query) {
            if ($this->area_id == 0) {
                return $query;
            } else {
                $query->where('area_id', $this->area_id);
            }
        })->where('fecha_dia', '>=', $this->fecha_inicio ? $this->fecha_inicio : '1900-01-01')->where('fecha_dia', '<=', $this->fecha_fin ? $this->fecha_fin : now()->format('Y-m-d'))->where('estatus', 'rechazado')->count();

        $this->emit('scriptTabla');

        return view('livewire.timesheet.reportes-registros');
    }

    public function todos()
    {
        $this->times = Timesheet::whereHas('empleado', function ($query) {
            if ($this->area_id == 0) {
                return $query;
            } else {
                $query->where('area_id', $this->area_id);
            }
        })->where('fecha_dia', '>=', $this->fecha_inicio ? $this->fecha_inicio : '1900-01-01')->where('fecha_dia', '<=', $this->fecha_fin ? $this->fecha_fin : now()->format('Y-m-d'))->orderByDesc('fecha_dia')->get();
    }

    public function papelera()
    {
        $this->times = Timesheet::whereHas('empleado', function ($query) {
            if ($this->area_id == 0) {
                return $query;
            } else {
                $query->where('area_id', $this->area_id);
            }
        })->where('fecha_dia', '>=', $this->fecha_inicio ? $this->fecha_inicio : '1900-01-01')->where('fecha_dia', '<=', $this->fecha_fin ? $this->fecha_fin : now()->format('Y-m-d'))->where('estatus', 'papelera')->orderByDesc('fecha_dia')->get();
    }

    public function pendientes()
    {
        $this->times = Timesheet::whereHas('empleado', function ($query) {
            if ($this->area_id == 0) {
                return $query;
            } else {
                $query->where('area_id', $this->area_id);
            }
        })->where('fecha_dia', '>=', $this->fecha_inicio ? $this->fecha_inicio : '1900-01-01')->where('fecha_dia', '<=', $this->fecha_fin ? $this->fecha_fin : now()->format('Y-m-d'))->where('estatus', 'pendiente')->orderByDesc('fecha_dia')->get();
    }

    public function aprobados()
    {
        $this->times = Timesheet::whereHas('empleado', function ($query) {
            if ($this->area_id == 0) {
                return $query;
            } else {
                $query->where('area_id', $this->area_id);
            }
        })->where('fecha_dia', '>=', $this->fecha_inicio ? $this->fecha_inicio : '1900-01-01')->where('fecha_dia', '<=', $this->fecha_fin ? $this->fecha_fin : now()->format('Y-m-d'))->where('estatus', 'aprobado')->orderByDesc('fecha_dia')->get();
    }

    public function rechazos()
    {
        $this->times = Timesheet::whereHas('empleado', function ($query) {
            if ($this->area_id == 0) {
                return $query;
            } else {
                $query->where('area_id', $this->area_id);
            }
        })->where('fecha_dia', '>=', $this->fecha_inicio ? $this->fecha_inicio : '1900-01-01')->where('fecha_dia', '<=', $this->fecha_fin ? $this->fecha_fin : now()->format('Y-m-d'))->where('estatus', 'rechazado')->orderByDesc('fecha_dia')->get();
    }
}
