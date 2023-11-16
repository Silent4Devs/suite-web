<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use OwenIt\Auditing\Contracts\Auditable;

class TimesheetHoras extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use Filterable;
    use HasFactory;

    protected $table = 'timesheet_horas';

    protected $appends = ['horas_totales_tarea'];

    protected $fillable = [
        'facturable',
        'timesheet_id',
        'proyecto_id',
        'tarea_id',
        'horas_lunes',
        'horas_martes',
        'horas_miercoles',
        'horas_jueves',
        'horas_viernes',
        'horas_sabado',
        'horas_domingo',
        'descripcion',
        'empleado_id',
    ];

    //Redis methods
    public static function getAll()
    {
        return Cache::remember('TimesheetHoras:timesheet_horas_all', 3600 * 2, function () {
            return self::select('id', 'proyecto_id', 'tarea_id', 'timesheet_id', 'horas_lunes', 'horas_martes', 'horas_miercoles', 'horas_jueves', 'horas_viernes', 'horas_sabado', 'horas_domingo', 'descripcion')->with('proyecto', 'tarea')->orderBy('id', 'asc')->get();
        });
    }

    public static function getData()
    {
        return Cache::remember('TimesheetHoras:timesheet_data_all', 3600 * 2, function () {
            return self::select('id', 'proyecto_id', 'tarea_id', 'timesheet_id', 'horas_lunes', 'horas_martes', 'horas_miercoles', 'horas_jueves', 'horas_viernes', 'horas_sabado', 'horas_domingo', 'descripcion')->orderBy('id', 'asc')->get();
        });
    }

    // public static function getDataCount()
    // {
    //     return Cache::remember('TimesheetHoras:timesheet_data_all_count', 3600 * 2, function () {
    //         return self::select('id')->orderBy('id', 'asc')->count();
    //     });
    // }

    public static function getDataProyTarea()
    {
        return Cache::remember('TimesheetHoras:timesheet_data_proy_tarea', 3600, function () {
            return self::with('proyecto', 'tarea')->get();
        });
    }

    public function timesheet()
    {
        return $this->belongsTo(Timesheet::class, 'timesheet_id');
    }

    public function proyecto()
    {
        return $this->belongsTo(TimesheetProyecto::class, 'proyecto_id');
    }

    public function tarea()
    {
        return $this->belongsTo(TimesheetTarea::class, 'tarea_id');
    }

    public function getHorasTotalesTareaAttribute()
    {
        $sumaHoras = (float)$this->horas_lunes +
            (float)$this->horas_martes +
            (float)$this->horas_miercoles +
            (float)$this->horas_jueves +
            (float)$this->horas_viernes +
            (float)$this->horas_sabado +
            (float)$this->horas_domingo;

        return $sumaHoras;
    }
}