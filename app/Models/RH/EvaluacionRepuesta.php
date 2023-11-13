<?php

namespace App\Models\RH;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EvaluacionRepuesta extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

    protected $table = 'ev360_competencias_respuestas';

    protected $guarded = ['id'];

    public function competencia()
    {
        return $this->belongsTo('App\Models\RH\Competencia', 'competencia_id', 'id');
    }

    public function evaluado()
    {
        return $this->belongsTo('App\Models\Empleado', 'evaluado_id', 'id');
    }

    public function evaluador()
    {
        return $this->belongsTo('App\Models\Empleado', 'evaluador_id', 'id');
    }

    public function evaluacion()
    {
        return $this->belongsTo('App\Models\RH\Evaluacion', 'evaluacion_id', 'id');
    }
}
