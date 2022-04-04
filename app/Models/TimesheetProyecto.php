<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimesheetProyecto extends Model
{
    use HasFactory;

    protected $table = 'timesheet_proyectos';

    protected $fillable = [
        'proyecto',
        'area_id',
        'cliente_id',
    ];

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    public function cliente()
    {
        return $this->belongsTo(TimesheetCliente::class, 'cliente_id');
    }

    public function tareas()
    {
        return $this->hasMany(TimesheetTarea::class, 'tarea_id', 'id');
    }
}
