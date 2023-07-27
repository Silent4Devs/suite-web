<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuestionarioRecursosHumanosAIA extends Model
{
    use HasFactory;

    public $table = 'recursos_humanos_aia';

    public $fillable = [
        'id',
        'empresa',
        'nombre',
        'a_paterno',
        'a_materno',
        'puesto',
        'rol',
        'tel',
        'correo',
        'escenario',
        'cuestionario_id',
    ];

    public function cuestionario()
    {
        return $this->belongsTo(AnalisisAIA::class, 'cuestionario_id', 'id');
    }
}
