<?php

namespace App\Models\RH;

use App\Traits\ClearsResponseCache;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MetricasObjetivo extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

    protected $table = 'ev360_metricas_objetivos';

    protected $guarded = ['id'];

    //Redis methods
    public static function getAll()
    {
        return Cache::remember('MetricasObjetivos_all', 3600 * 24, function () {
            return self::get();
        });
    }
}
