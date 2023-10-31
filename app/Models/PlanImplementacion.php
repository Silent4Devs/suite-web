<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PlanImplementacion extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

    protected $table = 'plan_implementacions';

    protected $appends = ['roles', 'resources'];

    protected $fillable = [
        'tasks',
        'canAdd',
        'canWrite',
        'canWriteOnParent',
        'changesReasonWhy',
        'selectedRow',
        'zoom',
        'parent',
        'norma',
        'modulo_origen',
        'objetivo',
        'elaboro_id',
        'plan_implementacionable_id',
        'plan_implementacionable_type',
        'archivo',
        'es_plan_trabajo_base',
    ];

    protected $casts = ['tasks' => 'object'];

    const NORMAS = [
        'ISO 27001' => 'ISO 27001',
        'ISO 31000' => 'ISO 31000',
        'ISO 9001' => 'ISO 9001',
        'ISO 22301' => 'ISO 22301',
        'ISO 37001' => 'ISO 37001',
    ];

    // public function tasks()
    // {
    //     return $this->hasMany(PlanImplementacionTask::class, 'plan_implementacion_id', 'id')->with('assigs');
    // }

    //Redis methods
    public static function getAll()
    {
        return Cache::remember('PlanImplementacion:implementaciones', 3600 * 8, function () {
            return self::get();
        });
    }

    public function getRolesAttribute()
    {
        $roles = Role::select('id', 'title as name')->get();

        return $roles;
    }

    public function getResourcesAttribute()
    {
        $empleado = Empleado::getaltaAll();

        return $empleado;
    }

    public function elaborador()
    {
        return $this->belongsTo(Empleado::class, 'elaboro_id', 'id')->alta();
    }

    public function matriz_requsitos_legales()
    {
        return $this->morphedByMany(MatrizRequisitoLegale::class, 'plan_implementacionable');
    }
}
