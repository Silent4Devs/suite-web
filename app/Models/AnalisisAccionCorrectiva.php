<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Rennokki\QueryCache\Traits\QueryCacheable;

class AnalisisAccionCorrectiva extends Model
{
    use HasFactory, SoftDeletes;
    use QueryCacheable;

    public $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;
    protected $table = 'analisis_accion_correctiva';

    protected $guarded = ['id'];

    public function accionCorrectiva()
    {
        return $this->belongsTo(AccionCorrectiva::class, 'accion_correctiva_id', 'id');
    }
}
