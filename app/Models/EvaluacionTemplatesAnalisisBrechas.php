<?php

namespace App\Models;

use App\Models\Iso27\AnalisisBrechasIso;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
class EvaluacionTemplatesAnalisisBrechas extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    protected $table = 'evaluacion_templates_analisis_brechas';

    protected $fillable = [
        'analisis_brechas_id',
        'template_id',
    ];

    public function respuestas()
    {
        return $this->hasMany(RespuestasEvaluacionAnalisisBrechas::class, 'ev_analisis_template_id', 'id');
    }

    public function templateAnalisisBrechas()
    {
        return $this->belongsTo(TemplateAnalisisdeBrechas::class, 'template_id', 'id');
    }

    public function analisisBrechasIsos()
    {
        return $this->belongsTo(AnalisisBrechasIso::class, 'analisis_brechas_id', 'id');
    }
}
