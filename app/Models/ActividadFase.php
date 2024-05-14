<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class ActividadFase extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'actividad_fases';

    protected $fillable = ['fase_nombre'];

    public function plan_base_actividades()
    {
        return $this->hasMany(PlanBaseActividade::class, 'actividad_fase_id', 'id');
    }
}
