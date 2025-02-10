<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TBRiskAnalysisGeneralModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $table = 'risk_analysis_general';

    protected $fillable = [
        'id',
        'name',
        'fecha',
        'status',
        'elaboro_id',
        'norma_id',
        'template_id',
    ];

    // Relationships

    public function elaboro()
    {
        return $this->belongsTo(Empleado::class, 'elaboro_id')->alta();
    }

    public function norma()
    {
        return $this->belongsTo(Norma::class, 'norma_id');
    }

    public function riskAnalysis()
    {
        return $this->hasOne(TBRiskAnalysisModel::class, 'id');
    }
}
