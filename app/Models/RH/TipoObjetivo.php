<?php

namespace App\Models\RH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class TipoObjetivo extends Model
{
    use HasFactory;

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
            return asset('storage/perspectivas/img/'.$this->imagen);
        }

        return asset('img/bullseye.png');
    }

    public function objetivos()
    {
        return $this->hasMany('App\Models\RH\Objetivo', 'tipo_id', 'id');
    }
}
