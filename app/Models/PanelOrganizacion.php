<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;

class PanelOrganizacion extends Model
{
    use HasFactory;
    use QueryCacheable;

    protected $table = 'panel_organizacions';
    public $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;
}
