<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;

class EvidenciasDenuncia extends Model
{
    use HasFactory;
    use QueryCacheable;

    public $cacheFor = 3600;
    protected static $flushCacheOnUpdate = true;
    protected $table = 'evidencias_denuncias';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'id_denuncias' => 'int',
        'evidencia' => 'string',
    ];

    protected $fillable = [
        'id_denuncias',
        'evidencia',
    ];

    public function denuncias()
    {
        return $this->belongsTo(Denuncias::class, 'id_denuncias');
    }
}
