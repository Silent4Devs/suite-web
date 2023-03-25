<?php

namespace App\Models\RH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetricasObjetivo extends Model
{
    use HasFactory;
    // public $cacheFor = 3600;
    // protected static $flushCacheOnUpdate = true;

    protected $table = 'ev360_metricas_objetivos';
    protected $guarded = ['id'];
}
