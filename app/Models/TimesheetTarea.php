<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use OwenIt\Auditing\Contracts\Auditable;

class TimesheetTarea extends Model implements Auditable
{
    use HasFactory;
    use Filterable;
    use \OwenIt\Auditing\Auditable;

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
        return Cache::remember('timesheettarea_all', 3600 * 24, function () {
            return self::orderByDesc('id')->get();
        });
    }

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

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id', 'id');
    }

    public function horas()
    {
        return $this->hasMany(TimesheetHoras::class, 'tarea_id', 'id');
    }
}
