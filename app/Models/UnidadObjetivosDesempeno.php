<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnidadObjetivosDesempeno extends Model
{
    use HasFactory;

    protected $table = 'unidad_objetivos_desempenos';

    protected $fillable = [
        'nombre',
        'valor_minimo',
        'valor_maximo'
    ];
}
