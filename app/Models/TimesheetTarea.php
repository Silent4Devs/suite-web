<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;

class TimesheetTarea extends Model
{
    use HasFactory;
    use Filterable;

    protected $table = 'timesheet_tareas';

    protected $appends = ['areas'];

    protected $fillable = [
        'tarea',
        'proyecto_id',
        'area_id',
        'todos',
    ];

    public function proyecto()
    {
        return $this->belongsTo(TimesheetProyecto::class, 'proyecto_id');
    }

    public function getAreasAttribute()
    {
        $areas = [];
        if ($this->todos == true) {
            foreach ($this->proyecto->areas as $key => $area) {
                array_push($areas, $area);
            }
        } else {
            $areas = [Area::find($this->area_id)];
        }
        return $areas;
    }

    public function areaData()
    {
        return $this->belongsTo(Area::class);
    }

    public function horas()
    {
        return $this->hasMany(TimesheetHoras::class, 'tarea_id', 'id');
    }
}
