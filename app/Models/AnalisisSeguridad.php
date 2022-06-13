<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnalisisSeguridad extends Model
{
    use HasFactory;

    protected $table = 'analisis_seguridad';

    protected $guarded = [
        'id',
    ];

    public function seguridad()
    {
        return $this->belongsTo(IncidentesSeguridad::class, 'seguridad_id');
    }
}
