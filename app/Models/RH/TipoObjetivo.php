<?php

namespace App\Models\RH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;

class TipoObjetivo extends Model
{
    use HasFactory;
    use QueryCacheable;

    public $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;
    protected $table = 'ev360_tipo_objetivos';
    protected $appends = ['imagen_ruta'];
    protected $guarded = ['id'];

    public function getImagenRutaAttribute()
    {
        if ($this->imagen) {
            return asset('storage/perspectivas/img/' . $this->imagen);
        }

        return asset('img/bullseye.png');
    }

    public function objetivos()
    {
        return $this->hasMany('App\Models\RH\Objetivo', 'tipo_id', 'id');
    }
}
