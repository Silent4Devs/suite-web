<?php

namespace App\Models\RH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjetivoCalificacion extends Model
{
    use HasFactory;

    protected $table = 'ev360_objetivos_calificaciones';
    protected $guarded = ['id'];
}
