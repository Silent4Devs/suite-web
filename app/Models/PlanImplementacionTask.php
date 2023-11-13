<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PlanImplementacionTask extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

    protected $table = 'plan_implementacion_tasks';

    protected $fillable = [
        'name',
        'progress',
        'progressByWorklog',
        'description',
        'level',
        'status',
        'depends',
        'start',
        'duration',
        'end',
        'startIsMilestone',
        'endIsMilestone',
        'collapsed',
        'canWrite',
        'canAdd',
        'canDelete',
        'canAddIssue',
        'id_fase',
        'id_task',
        'url',
        'plan_implementacion_id',
    ];

    public function plan()
    {
        return $this->belongsTo(PlanImplementacion::class, 'plan_implementacion_id', 'id');
    }

    public function assigs()
    {
        return $this->belongsToMany(Empleado::class, 'empleado_task')->alta();
    }
}
