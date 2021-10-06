<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeclaracionAplicabilidad extends Model
{
    use HasFactory;

    public $table = 'declaracion_aplicabilidad';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'control-uno',
        'control-dos',
        'anexo_indice',
        'control',
        'descripcion_control',
        'aplica',
        'justificacion',
        'created_at',
        'updated_at',
    ];
}
