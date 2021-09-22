<?php

namespace App\Models\RH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluadoEvaluador extends Model
{
    use HasFactory;
    protected $table = "ev360_evaluado_evaluador";
    protected $guarded = ['id'];

    public function evaluador()
    {
        return $this->belongsTo('App\Models\Empleado', 'evaluador_id', 'id');
    }
}
