<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimesheetProyecto extends Model
{
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
    ];

    public function getAreasAttribute()
    {
        $ids_areas = TimesheetProyectoArea::where('proyecto_id', $this->id)->get();

        $areas = collect();
        foreach ($ids_areas as $key => $area_p) {
            $areas->push(Area::select('id','area')->find($area_p->area_id));
        }

        return $areas;
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
        return $this->hasMany(QuejasCliente::class, 'proyectos_id');
    }
}
