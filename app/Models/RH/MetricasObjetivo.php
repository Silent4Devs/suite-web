<?php

namespace App\Models\RH;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use OwenIt\Auditing\Contracts\Auditable;

class MetricasObjetivo extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $table = 'ev360_metricas_objetivos';

    protected $guarded = ['id'];

    protected $fillable = [
        'definicion',
        'valor_minimo',
        'valor_maximo',
    ];

    // Redis methods
    public static function getAll()
    {
        return Cache::remember('MetricasObjetivos_all', 3600 * 24, function () {
            return self::get();
        });
    }
}
