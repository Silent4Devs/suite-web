<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Rennokki\QueryCache\Traits\QueryCacheable;

class EvidenciasQueja extends Model
{
    use SoftDeletes;
    use QueryCacheable;

    public $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;
    protected $table = 'evidencias_quejas';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'id_quejas' => 'int',
        'evidencia' => 'string',
    ];

    protected $fillable = [
        'id_quejas',
        'evidencia',
    ];

    public function quejas()
    {
        return $this->belongsTo(Quejas::class, 'id_quejas');
    }
}
