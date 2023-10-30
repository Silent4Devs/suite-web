<?php

namespace App\Models\RH;

use App\Traits\ClearsResponseCache;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TipoObjetivo extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

    protected $table = 'ev360_tipo_objetivos';

    protected $appends = ['imagen_ruta'];

    protected $guarded = ['id'];

    //Redis methods
    public static function getAll()
    {
        return Cache::remember('TipoObjetivo_all', 3600 * 24, function () {
            return self::get();
        });
    }

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
