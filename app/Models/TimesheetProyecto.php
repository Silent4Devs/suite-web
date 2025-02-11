<?php

namespace App\Models;

use App\Models\ContractManager\Contrato;
use App\Traits\ClearsResponseCache;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use OwenIt\Auditing\Contracts\Auditable;

class TimesheetProyecto extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use Filterable;
    use HasFactory;

    protected $table = 'timesheet_proyectos';

    protected $appends = ['areas'];

    protected $fillable = [
        'proyecto',
        'cliente_id',
        'estatus',
        'fecha_fin',
        'fecha_inicio',
        'identificador',
        'sede_id',
        'tipo',
        'horas_proyecto',
    ];

    const TIPOS = [
        'Interno' => 'Interno',
        'Externo' => 'Externo',
    ];

    // Redis methods
    public static function getAll($proyecto_id = null)
    {
        if (is_null($proyecto_id)) {
            return Cache::remember('TimesheetProyecto:timesheetproyecto_all', 3600 * 4, function () {
                return self::orderBy('identificador', 'ASC')->get();
            });
        } else {
            return Cache::remember('TimesheetProyecto:timesheetproyecto_show_'.$proyecto_id, 3600, function () {
                return self::orderBy('identificador', 'ASC')->get();
            });
        }
    }

    public static function getAllWithData()
    {
        return Cache::remember('TimesheetProyecto:proyectos_with_tasks', 3600 * 4, function () {
            return self::with('tareas:id,tarea,proyecto_id,area_id,todos')
                ->select('id', 'proyecto', 'identificador')
                ->orderBy('identificador', 'ASC')
                ->get();
        });
    }

    public static function getAllDashboard()
    {
        return Cache::remember('TimesheetProyecto:proyectos_dashboard', 3600 * 4, function () {
            return self::select('id', 'proyecto', 'estatus')->get();
        });
    }

    public static function getIdNameAll($proyecto_id = null)
    {
        if (is_null($proyecto_id)) {
            return Cache::remember('TimesheetProyecto:timesheetproyecto_all', 3600 * 4, function () {
                return self::select('id', 'identificador', 'proyecto', 'cliente_id', 'tipo', 'estatus')->orderBy('identificador', 'ASC')->get();
            });
        } else {
            return Cache::remember('TimesheetProyecto:timesheetproyecto_show_'.$proyecto_id, 3600, function () {
                return self::select('id', 'identificador', 'proyecto', 'cliente_id', 'tipo', 'estatus')->orderBy('identificador', 'ASC')->get();
            });
        }
    }

    public static function getAllOrderByIdentificador()
    {
        return Cache::remember('TimesheetProyecto:timesheetproyecto_all_order_by_identificador', 3600, function () {
            return self::orderBy('identificador', 'ASC')->get();
        });
    }

    public static function getAllWithCliente()
    {
        return Cache::remember('TimesheetProyecto:timesheetproyecto_all_with_cliente', 3600 * 3, function () {
            return self::with('cliente')->orderBy('identificador', 'ASC')->get();
        });
    }

    public static function getAllByProceso()
    {
        return Cache::remember('TimesheetProyecto:timesheetproyecto_all_order_by_proceso', 3600 * 4, function () {
            return self::where('estatus', 'proceso')->orderBy('identificador', 'ASC')->get();
        });
    }

    public function getAreasAttribute()
    {
        $ids_areas = TimesheetProyectoArea::where('proyecto_id', $this->id)->get();

        $areas = collect();
        foreach ($ids_areas as $key => $area_p) {
            $areas->push(Area::select('id', 'area')->find($area_p->area_id));
        }

        return $areas;
    }

    public function getEmpleadosAttribute()
    {
        $ids_emp = TimesheetProyectoEmpleado::where('proyecto_id', $this->id)->get();

        $emps = [];
        foreach ($ids_emp as $key => $emp_p) {
            $horas = TimesheetHoras::where('proyecto_id', $this->id)->where('empleado_id', $emp_p->id)->get();
            $horas_totales = 0;
            foreach ($horas as $hora) {
                $horas_totales += is_numeric($hora->horas_lunes) ? $hora->horas_lunes : 0;
                $horas_totales += is_numeric($hora->horas_martes) ? $hora->horas_martes : 0;
                $horas_totales += is_numeric($hora->horas_miercoles) ? $hora->horas_miercoles : 0;
                $horas_totales += is_numeric($hora->horas_jueves) ? $hora->horas_jueves : 0;
                $horas_totales += is_numeric($hora->horas_viernes) ? $hora->horas_viernes : 0;
                $horas_totales += is_numeric($hora->horas_sabado) ? $hora->horas_sabado : 0;
                $horas_totales += is_numeric($hora->horas_domingo) ? $hora->horas_domingo : 0;
            }
            if (isset($emp_p->empleado->salario_base_mensual)) {
                $costo_hora = ($emp_p->empleado->salario_base_mensual / 20) / 7;
            } else {
                if (isset($emp_p->empleado->salario_diario)) {
                    $costo_hora = $emp_p->empleado->salario_diario / 7;
                } else {
                    $costo_hora = 0;
                }
            }
            $costo_horas = $costo_hora * $horas_totales;
            $empItem = Empleado::select('id', 'name')->where('id', $emp_p->empleado_id)->first();
            array_push($emps, [
                'id' => $empItem->id,
                'name' => $empItem->name,
                'horas' => $horas_totales,
                'costo_horas' => $costo_horas,
            ]);
        }

        return $emps;

    }

    public function getHorasTotalesLlenasAttribute()
    {
        $horas = TimesheetHoras::where('proyecto_id', $this->id)->get();
        $horas_totales = 0;
        foreach ($horas as $hora) {
            $horas_totales += is_numeric($hora->horas_lunes) ? $hora->horas_lunes : 0;
            $horas_totales += is_numeric($hora->horas_martes) ? $hora->horas_martes : 0;
            $horas_totales += is_numeric($hora->horas_miercoles) ? $hora->horas_miercoles : 0;
            $horas_totales += is_numeric($hora->horas_jueves) ? $hora->horas_jueves : 0;
            $horas_totales += is_numeric($hora->horas_viernes) ? $hora->horas_viernes : 0;
            $horas_totales += is_numeric($hora->horas_sabado) ? $hora->horas_sabado : 0;
            $horas_totales += is_numeric($hora->horas_domingo) ? $hora->horas_domingo : 0;
        }

        return $horas_totales;
    }

    public function getIsNumAttribute()
    {
        if (is_numeric($this->identificador[0])) {
            preg_match('/^\d+/', $this->identificador, $matches);

            return $matches[0];
        }
        if (ctype_alpha($this->identificador[0])) {
            return 0;
        }
    }

    public function sede()
    {
        return $this->belongsTo(Sede::class, 'sede_id');
    }

    public function cliente()
    {
        return $this->belongsTo(TimesheetCliente::class, 'cliente_id');
    }

    public function tareas()
    {
        return $this->hasMany(TimesheetTarea::class, 'proyecto_id', 'id');
    }

    public function proyectos()
    {
        return $this->hasMany(TimesheetProyectoEmpleado::class, 'proyecto_id', 'id');
    }

    public function proveedores()
    {
        return $this->hasMany(TimesheetProyectoProveedor::class, 'proyecto_id', 'id');
    }

    public function clienteConvergencia()
    {
        return $this->hasOneThrough(
            TimesheetCliente::class,
            ConvergenciaContratos::class,
            'timesheet_cliente_id', // Foreign key on the convergence table...
            'id', // Foreign key on the timesheet proyectos table...
            'id', // Local key on the contratos table...
            'timesheet_proyecto_id' // Local key on the convergence table...
        );
    }

    public function contratosConvergencia()
    {
        return $this->hasManyThrough(
            Contrato::class,
            ConvergenciaContratos::class,
            'timesheet_proyecto_id', // Foreign key on the convergence table...
            'id', // Foreign key on the contratos table...
            'id', // Local key on the timesheet proyectos table...
            'contrato_id' // Local key on the convergence table...
        );
    }
}
