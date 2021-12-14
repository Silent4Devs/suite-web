<?php

namespace App\Models\RH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;

class ObjetivoComentario extends Model
{
    use HasFactory, QueryCacheable;
    public $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;

    protected $table = 'ev360_objetivos_comentarios';
    protected $guarded = ['id'];

    const EVALUADOR = '1';
    const EVALUADO = '2';

    public function objetivos()
    {
        return $this->belongsToMany('App\Models\RH\Objetivo', 'ev360_objetivos_comentarios_pivot', 'comentario_id', 'objetivo_id');
    }
}
