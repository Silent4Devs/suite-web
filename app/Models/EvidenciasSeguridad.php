<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class EvidenciasSeguridad extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $table = 'evidencias_seguridad';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'id_seguridad' => 'int',
        'evidencia' => 'string',
    ];

    protected $fillable = [
        'id_seguridad',
        'evidencia',
    ];

    public function seguridad()
    {
        return $this->belongsTo(IncidentesSeguridad::class, 'id_seguridad');
    }
}
