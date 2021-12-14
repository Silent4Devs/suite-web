<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Rennokki\QueryCache\Traits\QueryCacheable;
class EntendimientoOrganizacion extends Model
{
    use HasFactory;
    use SoftDeletes;
    use QueryCacheable;

    public $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;
    protected $table = 'entendimiento_organizacions';
    protected $fillable = [
        'fortalezas',
        'oportunidades',
        'debilidades',
        'amenazas',
        'analisis',
        'fecha',
        'id_elabora',

    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_elabora', 'id');
    }
}
