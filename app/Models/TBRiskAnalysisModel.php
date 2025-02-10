<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TBRiskAnalysisModel extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'risk_analysis';

    protected $fillable = [
        'id',
        'nombre',
        'norma_id',
        'descripcion',
        'general_id',
    ];

    // Relations
    public function riskAnalysisGeneral()
    {
        return $this->belongsTo(TBRiskAnalysisGeneralModel::class, 'general_id');
    }

    public function norma()
    {
        return $this->belongsTo(Norma::class, 'norma_id');
    }

    public function scales()
    {
        return $this->belongsTo(TBRiskAnalysis_ScalesArModel::class, 'id');
    }

    public function prob_imp()
    {
        return $this->belongsTo(TBRiskAnalysisProbImpModel::class, 'id');
    }
}
