<?php

namespace App\Models\Iso9001;

use App\Models\Empleado;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlanImplementacion extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'plan_implementacion_9001';
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
    ];

    protected $casts = ['tasks' => 'object'];

    const NORMAS = [
        'ISO 27001' => 'ISO 27001',
    ];

    // public function tasks()
    // {
    //     return $this->hasMany(PlanImplementacionTask::class, 'plan_implementacion_id', 'id')->with('assigs');
    // }

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
