<?php

namespace App\Models\RH;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MetricasObjetivo extends Model
{
    use HasFactory;
    // public $cacheFor = 3600;
    // protected static $flushCacheOnUpdate = true;

    protected $table = 'ev360_metricas_objetivos';
    protected $guarded = ['id'];

    #Redis methods
    public static function getAll()
    {
        return Cache::remember('MetricasObjetivos_all', 3600 * 24, function () {
            return self::get();
        });
    }
}
