<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use OwenIt\Auditing\Contracts\Auditable;

class FelicitarCumpleaños extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $table = 'felicitaciones_cumpleaños';

    protected $fillable = [
        'cumpleañero_id',
        'felicitador_id',
        'comentarios',
        'like',
    ];

    //Redis methods
    public static function getAllWhereYear($usuario, $hoy)
    {
        return Cache::remember('Cumpleaños:cumpleaños_'.$usuario, 3600 * 2, function () use ($hoy, $usuario) {
            return self::where('cumpleañero_id', $usuario)->whereYear('created_at', $hoy)->get();
        });
    }

    public function cumpleañero()
    {
        return $this->belongsTo(Empleado::class, 'cumpleañero_id')->alta();
    }

    public function felicitador()
    {
        return $this->belongsTo(Empleado::class, 'felicitador_id')->alta();
    }
}
