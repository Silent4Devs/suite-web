<?php

namespace App\Models\Iso9001;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;

class LockedPlanTrabajo extends Model
{
    use HasFactory;
    use QueryCacheable;

    public $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;

    protected $table = 'locked_plan_trabajos_9001';
    protected $dates = ['locked_to'];
    protected $fillable = [
        'locked_to',
        'blocked',
        'locked_by',
    ];
}
