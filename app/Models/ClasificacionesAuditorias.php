<?php

namespace App\Models;

use App\Models\AuditoriaInternaHallazgos;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClasificacionesAuditorias extends Model
{
    use HasFactory;

    protected $table = 'clasificaciones_auditorias';

    protected $fillable = [
        'identificador',
        'nombre_clasificaciones',
        'descripcion',
    ];
}
