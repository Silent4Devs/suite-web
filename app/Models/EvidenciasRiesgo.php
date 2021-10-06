<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvidenciasRiesgo extends Model
{
    use HasFactory;

    protected $table = 'evidencias_riesgos';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'id_riesgos' => 'int',
        'evidencia' => 'string',
    ];

    protected $fillable = [
        'id_riesgos',
        'evidencia',
    ];

    public function riesgos()
    {
        return $this->belongsTo(RiesgoIdentificado::class, 'id_riesgos');
    }
}
