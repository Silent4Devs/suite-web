<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TBProbabilidadImpactoAnalisisRiesgoModel extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'prob_imp_analisis_riesgos';

    protected $fillable = [
        'id',
        'nombre',
        'valor',
        'color',
        'min_max_id',
    ];
}
