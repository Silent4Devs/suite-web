<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnalisisImpacto extends Model
{
    use HasFactory;


    public $table = 'cuestionario_analisis_impacto';



    public $fillable = [
        'id',
        'fecha_entrevista',
        'entrevistado',
        'puesto',
        'area',
        'direccion',
        'extencion',
        'correo',
        'procesos_a_cargo',
        'id_proceso',
        'nombre_proceso',
        'version',
        'tipo',
        'objetivo_proceso',
        'periodicidad',
        'p_otro_txt',
    ];
}
