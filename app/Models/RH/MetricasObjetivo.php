<?php

namespace App\Models\RH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;

class MetricasObjetivo extends Model
{
    use HasFactory, QueryCacheable;
    public $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;

    protected $table = 'ev360_metricas_objetivos';
    protected $guarded = ['id'];
}
