<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuestionarioInfraestructuraTecnologica extends Model
{
    use HasFactory;

    public $table = "cuestionario_infraestructura_tecnologica";

    public $fillable = [
        'id',
        'sistemas',
        'aplicativos',
        'base_datos',
        'otro',
        'escenario',
        'cuestionario_id',
    ];

    public function cuestionario()
    {
        return $this->belongsTo(AnalisisImpacto::class, 'cuestionario_id', 'id');
    }
}
