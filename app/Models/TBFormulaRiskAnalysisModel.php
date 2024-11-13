<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TBFormulaRiskAnalysisModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $table = 'formulas_risk_analysis';

    protected $fillable = [
        'id',
        'title',
        'formula',
        'riesgo',
        'risk_analysis_id',
        'section_id',
        'question_id',
    ];
}
