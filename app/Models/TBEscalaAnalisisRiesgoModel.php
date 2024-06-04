<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TBEscalaAnalisisRiesgoModel extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'escalas_analisis_riesgos';

    protected $fillable = [
        'id',
        'nombre',
        'valor',
        'color',
        'riesgo_aceptable',
        'min_max_id',
    ];
}
