<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimesheetProyectoEmpleado extends Model
{
    use HasFactory;

    protected $table = 'timesheet_proyectos_empleados';

    protected $appends = ['areas'];

    protected $fillable = [
        'proyecto_id',
        'empleado_id',
        'area_id',
        'horas_asignadas',
        'costo_hora',
    ];
}
