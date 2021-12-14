<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Mejoras extends Model
{
    use HasFactory;
    use QueryCacheable;

    public $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;
    protected $table = 'mejoras';

    protected $guarded = [
        'id',
    ];

    protected $appends = ['folio'];

    public function getFolioAttribute()
    {
        return  sprintf('MJA-%04d', $this->id);
    }

    public function mejoro()
    {
        return $this->belongsTo(Empleado::class, 'empleado_mejoro_id', 'id');
    }

    public function planes()
    {
        return $this->morphToMany(PlanImplementacion::class, 'plan_implementacionable');
    }

    public function actividades()
    {
        return $this->hasMany(ActividadMejora::class, 'mejora_id', 'id');
    }
}
