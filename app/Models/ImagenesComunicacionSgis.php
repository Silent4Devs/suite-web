<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Rennokki\QueryCache\Traits\QueryCacheable;

class ImagenesComunicacionSgis extends Model
{
    use SoftDeletes;
    use QueryCacheable;

    public $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;
    public $table = 'imagenes_comunicacion_sgis';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'comunicacion_id',
        'imagen',

    ];

    public function imagenes_comunicacion()
    {
        return $this->belongsTo(ComunicacionSgi::class, 'comunicacion_id');
    }
}
