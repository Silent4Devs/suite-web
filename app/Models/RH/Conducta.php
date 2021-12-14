<?php

namespace App\Models\RH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Conducta extends Model
{
    use HasFactory, QueryCacheable;
    public $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;

    protected $table = 'ev360_competencias_opciones';
    protected $appends = ['definicion_h'];
    protected $guarded = ['id'];

    public function getDefinicionHAttribute()
    {
        return strip_tags(html_entity_decode($this->definicion));
    }
}
