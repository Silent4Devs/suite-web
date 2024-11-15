<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TBSettingsAr_QuestionsArModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $table = 'settings_risk_analysis_questions_ar_pivote';

    protected $fillable = [
        'id',
        'risk_analysis_id',
        'question_id',
        'is_show',
    ];

    public function question()
    {
        return $this->belongsTo(TBQuestionRiskAnalysisModel::class, 'question_id');
    }
}
