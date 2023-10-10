<?php

namespace App\Models\RH;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class EvaluadoEvaluador extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'ev360_evaluado_evaluador';

    protected $guarded = ['id'];

    protected $appends = ['progreso_competencias', 'progreso_objetivos'];

    const AUTOEVALUACION = 0;

    const JEFE_INMEDIATO = 1;

    const MISMA_AREA = 2;

    const EQUIPO = 3;

    public function getTipoFormateadoAttribute()
    {
        switch ($this->tipo) {
            case '0':
                return 'Autoevaluación';
                break;
            case '1':
                return 'Jefe Inmediato';
                break;
            case '2':
                return 'Misma Área';
                break;
            case '3':
                return 'Equipo a Cargo';
                break;
            default:
                //Code...
                break;
        }
    }

    public function empleado_evaluado()
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

    public function getProgresoCompetenciasAttribute()
    {
        $preguntas_sql = EvaluacionRepuesta::where('evaluacion_id', $this->evaluacion_id)
            ->where('evaluado_id', $this->evaluado_id)
            ->where('evaluador_id', $this->evaluador_id);
        $total_preguntas = $preguntas_sql->count();
        $preguntas_contestadas = EvaluacionRepuesta::where('evaluacion_id', $this->evaluacion_id)
            ->where('evaluado_id', $this->evaluado_id)
            ->where('evaluador_id', $this->evaluador_id)
            ->where('calificacion', '>', 0)->count();
        if ($total_preguntas) {
            $progreso = floatval(number_format((($preguntas_contestadas / $total_preguntas) * 100)));
        } else {
            $progreso = 0;
        }

        return $progreso;
    }

    public function getProgresoObjetivosAttribute()
    {
        $objetivos = ObjetivoRespuesta::where('evaluado_id', $this->evaluado_id)
            ->where('evaluador_id', $this->evaluador_id)
            ->where('evaluacion_id', $this->evaluacion_id)
            ->count();
        $objetivos_evaluados = ObjetivoRespuesta::where('evaluado_id', $this->evaluado_id)
            ->where('evaluador_id', $this->evaluador_id)
            ->where('evaluacion_id', $this->evaluacion_id)
            ->where('evaluado', true)
            ->count();
        if ($objetivos) {
            $progreso_objetivos = floatval(number_format((($objetivos_evaluados / $objetivos) * 100)));
        } else {
            $progreso_objetivos = 0;
        }

        return $progreso_objetivos;
    }
}
