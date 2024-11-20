<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TBSettingsAr_FormulasArModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $table = 'settings_risk_analysis_formulas_ar_pivote';

    protected $fillable = [
        'id',
        'risk_analysis_id',
        'formula_id',
        'is_show',
    ];

    public function formula()
    {
        return $this->belongsTo(TBFormulaRiskAnalysisModel::class, 'formula_id');
    }
}
