<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;

class EvidenciasSeguridad extends Model
{
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
