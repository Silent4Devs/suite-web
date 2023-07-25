<?php

namespace App\Models\RH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluacionObjetivo extends Model
{
    use HasFactory;

    protected $table = 'ev360_evaluacion_objetivos';
    protected $guarded = ['id'];

    public function objetivo()
    {
        return $this->belongsTo('App\Models\RH\Objetivo', 'objetivo_id', 'id');
    }
}
