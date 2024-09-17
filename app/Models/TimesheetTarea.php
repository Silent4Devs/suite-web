<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use OwenIt\Auditing\Contracts\Auditable;

class TimesheetTarea extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use Filterable;
    use HasFactory;

    protected $table = 'timesheet_tareas';

    protected $appends = ['areas'];

    protected $fillable = [
        'tarea',
        'proyecto_id',
        'area_id',
        'todos',
    ];

    //Redis methods
    public static function getAll()
    {
        return Cache::remember('TimesheetTarea:timesheettarea_all', 3600 * 4, function () {
            return self::orderByDesc('id')->get();
        });
    }

    public static function getIdTareasAll()
    {
        return Cache::remember('TimesheetTarea:getIdTareasAll', 3600 * 4, function () {
            return self::select('id', 'tarea', 'proyecto_id', 'area_id', 'todos')->orderByDesc('id')->get();
        });
    }

    public function proyecto()
    {
        return $this->belongsTo(TimesheetProyecto::class, 'proyecto_id');
    }

    public function getAreasAttribute()
    {
        $areas = [];

        // Verificar si $this->proyecto no es nulo
        if ($this->proyecto !== null) {
            // Verificar si $this->todos es true y si $this->proyecto->areas es un array
            if ($this->todos && is_array($this->proyecto->areas)) {
                foreach ($this->proyecto->areas as $key => $area) {
                    array_push($areas, $area);
                }
            } else {
                // Si $this->todos no es true o $this->proyecto->areas no es un array,
                // agregar el área encontrada por su ID
                $areas = [Area::find($this->area_id)];
            }
        }

        return $areas;
    }

    public function areaData()
    {
        return $this->belongsTo(Area::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id', 'id');
    }

    public function horas()
    {
        return $this->hasMany(TimesheetHoras::class, 'tarea_id', 'id');
    }
}
