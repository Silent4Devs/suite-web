<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TimesheetHoras extends Model implements Auditable
{
    use HasFactory;
    use Filterable;
    use \OwenIt\Auditing\Auditable;
    protected $table = 'timesheet_horas';

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
        return Cache::remember('Timesheet:timesheet_horas_all', 3600, function () {
            return self::select('id', 'timesheet_id', 'horas_lunes', 'horas_martes', 'horas_miercoles', 'horas_jueves', 'horas_viernes', 'horas_sabado', 'horas_domingo')->orderBy('id', 'asc')->get();
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
}
