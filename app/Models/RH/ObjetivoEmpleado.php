<?php

namespace App\Models\RH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;

class ObjetivoEmpleado extends Model
{
    use HasFactory, QueryCacheable;
    public $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;
    protected $table = 'ev360_objetivo_empleados';
    protected $fillable = ['empleado_id', 'objetivo_id', 'completado'];

    public function objetivo()
    {
        return $this->belongsTo('App\Models\RH\Objetivo', 'objetivo_id', 'id');
    }
}
