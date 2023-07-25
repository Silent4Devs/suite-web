<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimesheetHoras extends Model
{
    use HasFactory;
    use Filterable;

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
