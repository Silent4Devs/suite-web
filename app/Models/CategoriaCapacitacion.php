<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use OwenIt\Auditing\Contracts\Auditable;

class CategoriaCapacitacion extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory, SoftDeletes;

    protected $table = 'categoria_capacitacions';

    protected $fillable = ['nombre'];

    public static function getAll()
    {
        return Cache::remember('CategoriaCapacitacion:categoriacapacitacion_all', 3600 * 7, function () {
            return self::orderByDesc('id')->get();
        });
    }

    public static function getAllWithRecursos()
    {
        return Cache::remember('CategoriaCapacitacion:categoriacapacitacion_with_recursos', 3600 * 7, function () {
            return self::with('recursos')->get();
        });
    }

    public function recursos()
    {
        return $this->hasMany(Recurso::class);
    }
}
