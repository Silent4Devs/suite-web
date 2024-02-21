<?php

namespace App\Models;

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

    //Redis methods
    public static function getAll($proyecto_id = null)
    {
        if (is_null($proyecto_id)) {
            return Cache::remember('TimesheetProyecto:timesheetproyecto_all', 3600 * 4, function () {
                return self::orderBy('proyecto')->get();
            });
        } else {
            return Cache::remember('TimesheetProyecto:timesheetproyecto_show_' . $proyecto_id, 3600, function () {
                return self::orderBy('proyecto')->get();
            });
        }
    }

    public static function getAllWithData()
    {
        return Cache::remember('TimesheetProyecto:proyectos_with_tasks', 3600 * 4, function () {
            return self::with('tareas:id,tarea,proyecto_id,area_id,todos')
                ->select('id', 'proyecto', 'identificador')
                ->get();
        });
    }

    public static function getIdNameAll($proyecto_id = null)
    {
        if (is_null($proyecto_id)) {
            return Cache::remember('TimesheetProyecto:timesheetproyecto_all', 3600 * 4, function () {
                return self::select('id', 'identificador', 'proyecto', 'cliente_id', 'tipo')->orderBy('proyecto')->get();
            });
        } else {
            return Cache::remember('TimesheetProyecto:timesheetproyecto_show_' . $proyecto_id, 3600, function () {
                return self::select('id', 'identificador', 'proyecto', 'cliente_id', 'tipo')->orderBy('proyecto')->get();
            });
        }
    }

    public static function getAllOrderByIdentificador()
    {
        return Cache::remember('TimesheetProyecto:timesheetproyecto_all_order_by_identificador', 3600, function () {
            return self::orderBy('id', 'desc')->get();
        });
    }

    public static function getAllWithCliente()
    {
        return Cache::remember('TimesheetProyecto:timesheetproyecto_all_with_cliente', 3600 * 3, function () {
            return self::with('cliente')->orderBy('id', 'desc')->get();
        });
    }

    public static function getAllByProceso()
    {
        return Cache::remember('TimesheetProyecto:timesheetproyecto_all_order_by_proceso', 3600 * 4, function () {
            return self::where('estatus', 'proceso')->orderBy('id', 'desc')->get();
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

        $emps = collect();
        foreach ($ids_emp as $key => $emp_p) {
            $emps->push(Empleado::select('id')->find($emp_p->empleado_id));
        }

        return $emps;
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
}