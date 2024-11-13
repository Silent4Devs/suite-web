<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EscalasEvaluacionDesempeno extends Model
{
    use HasFactory;

    protected $table = 'escalas_evaluacion_desempenos';

    protected $fillable = [
        'evaluacion_desempeno_id',
        'parametro',
        'valor',
        'color',
        // 'descripcion',
    ];

    public function evaluacion()
    {
        return $this->belongsTo(EvaluacionDesempeno::class, 'evaluacion_desempeno_id', 'id');
    }
}
