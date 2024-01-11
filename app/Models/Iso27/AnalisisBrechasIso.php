<?php

namespace App\Models\Iso27;

use App\Models\Empleado;
use App\Models\EvaluacionAnalisisBrechas;
use App\Models\EvaluacionTemplatesAnalisisBrechas;
use App\Models\Norma;
use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class AnalisisBrechasIso extends Model implements Auditable
{
    use ClearsResponseCache, HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'id',
        'nombre',
        'fecha',
        'porcentaje_implementacion',
        'id_elaboro',
        'estatus',
        'norma_id',
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_elaboro')->alta();
    }

    public function norma()
    {
        return $this->belongsTo(Norma::class, 'norma_id');
    }

    public function evaluacionTemplateAnalisisBrechas()
    {
        return $this->hasOne(EvaluacionTemplatesAnalisisBrechas::class, 'analisis_brechas_id', 'id');
    }

    public function evaluacionAnalisisBrechas()
    {
        return $this->hasOne(EvaluacionAnalisisBrechas::class, 'analisis_brechas_id', 'id');
    }
    // public function evaluacion(){
    //     return $this->hasOne(EvaluacionTemplatesAnalisisBrechas::class, );
    // }

    // public function gap_logro_tres()
    // {
    //     return $this->hasMany(GapTre::class, 'analisis_brechas_id');
    // }

    // public function gap_logro_dos()
    // {
    //     return $this->hasMany(GapDo::class, 'analisis_brechas_id');
    // }

    // public function gap_logro_unos()
    // {
    //     return $this->hasMany(GapUno::class, 'analisis_brechas_id');
    // }
}
