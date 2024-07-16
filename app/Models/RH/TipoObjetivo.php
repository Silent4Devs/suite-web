<?php

namespace App\Models\RH;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use OwenIt\Auditing\Contracts\Auditable;

class TipoObjetivo extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $table = 'ev360_tipo_objetivos';

    protected $appends = ['imagen_ruta', 'tipo_ocupado'];

    protected $guarded = ['id'];

    //Redis methods
    public static function getAll()
    {
        return Cache::remember('TipoObjetivo_all', 3600 * 24, function () {
            return self::orderBy('id')->get();
        });
    }

    public function getImagenRutaAttribute()
    {
        if ($this->imagen) {
            return asset('storage/perspectivas/img/'.$this->imagen);
        }

        return asset('img/bullseye.png');
    }

    public function objetivos()
    {
        return $this->hasMany('App\Models\RH\Objetivo', 'tipo_id', 'id');
    }

    public function getTipoOcupadoAttribute()
    {
        return Objetivo::where('tipo_id', $this->id)
            ->exists();
    }
}
