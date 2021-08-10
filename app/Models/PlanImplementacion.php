<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlanImplementacion extends Model
{
    use HasFactory, SoftDeletes;

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
        'slug'
    ];

    protected $casts = ['tasks' => 'object'];

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
        $empleado = Empleado::all();
        return $empleado;
    }
}
