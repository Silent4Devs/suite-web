<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Venturecraft\Revisionable\RevisionableTrait;

class TBTemplateAnalisisRiesgoModel extends Model
{
    use HasFactory;
    use RevisionableTrait;

    protected $guarded = ['id'];

    protected $table = 'template_analisis_riesgos';

    protected $fillable = [
        'id',
        'nombre',
        'norma_id',
        'descripcion',
        'status',
        'top',
    ];

    //Relations
    public function norma()
    {
        return $this->belongsTo(Norma::class, 'norma_id');
    }

    public function getAr_Escala()
    {
        return $this->belongsTo(TBTemplateAr_EscalaArModel::class, 'id');
    }

    public function getAR_Probabilidad_Impacto()
    {
        return $this->belongsTo(TBTemplateArProbImpArModel::class, 'id');
    }
}
