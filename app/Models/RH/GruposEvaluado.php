<?php

namespace App\Models\RH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;
class GruposEvaluado extends Model
{
    use HasFactory, QueryCacheable;
    public $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;
    protected $table = 'ev360_grupos_evaluados';
    protected $fillable = ['nombre'];

    public function empleados()
    {
        return $this->belongsToMany('App\Models\Empleado', 'ev360_empleados_grupos_evaluados', 'grupo_id', 'empleado_id');
    }
}
