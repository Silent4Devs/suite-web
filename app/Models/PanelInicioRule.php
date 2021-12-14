<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;

class PanelInicioRule extends Model
{
    use HasFactory;
    use QueryCacheable;
    protected $table = 'panel_inicio_rules';
    public $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;
}
