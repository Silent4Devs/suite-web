<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;

class AnalisisSeguridad extends Model
{
    use HasFactory;
    use QueryCacheable;

    public $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;
    protected $table = 'analisis_seguridad';

    protected $guarded = [
        'id',
    ];

    public function seguridad()
    {
        return $this->belongsTo(IncidentesSeguridad::class, 'seguridad_id');
    }
}
