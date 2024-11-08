<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TBSheetRiskAnalysisModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $table = 'sheet_risk_analysis';

    protected $fillable = [
        'id',
        'risk_analysis_id',
        'initial_risk_confirm',
        'residual_risk_confirm',
        'require_treatment_plan',
        'treatment_plan_id',
    ];

    public function answersSheet()
    {
        return $this->belongsToMany(TBAnswerSheetRiskAnalysisModel::class, 'answers_sheet_risk_analysis_pivote', 'sheet_id', 'answer_id')->orderBy('id');
    }
}
