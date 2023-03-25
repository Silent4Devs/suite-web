<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Rennokki\QueryCache\Traits\QueryCacheable;

class ActividadFase extends Model
{
    use HasFactory, SoftDeletes;
    use QueryCacheable;

    public $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;
    protected $dates = ['deleted_at'];

    protected $table = 'actividad_fases';

    protected $fillable = ['fase_nombre'];

    public function plan_base_actividades()
    {
        return $this->hasMany(PlanBaseActividade::class, 'actividad_fase_id', 'id');
    }
}
