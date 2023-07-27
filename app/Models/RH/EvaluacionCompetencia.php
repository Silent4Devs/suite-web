<?php

namespace App\Models\RH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluacionCompetencia extends Model
{
    use HasFactory;

    protected $table = 'ev360_competencia_evaluacion';

    protected $guarded = ['id'];

    public function competencia()
    {
        return $this->belongsTo('App\Models\RH\Competencia', 'competencia_id', 'id');
    }
}
