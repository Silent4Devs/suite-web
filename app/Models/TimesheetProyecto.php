<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;
use Illuminate\Support\Facades\Cache;

class TimesheetProyecto extends Model
{
    use HasFactory;
    use Filterable;

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

    #Redis methods
    public static function getAll()
    {
        return Cache::remember('timesheetproyecto_all', 3600 * 24, function () {
            return self::get();
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
