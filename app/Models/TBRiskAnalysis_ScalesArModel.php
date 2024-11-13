<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TBRiskAnalysis_ScalesArModel extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'risk_analysis_scales_ar_pivote';

    protected $fillable = [
        'id',
        'risk_analysis_id',
        'valor_min',
        'valor_max',
    ];

    public function riskAnalysis()
    {
        return $this->belongsTo(TBRiskAnalysisModel::class, 'risk_analysis_id');
    }

    public function scales()
    {
        return $this->hasMany(TBRiskAnalysisScaleModel::class, 'min_max_id', 'id')->orderBy('id', 'asc');
    }
}
