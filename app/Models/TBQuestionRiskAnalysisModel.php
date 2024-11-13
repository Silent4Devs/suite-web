<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TBQuestionRiskAnalysisModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $table = 'questions_risk_analysis';

    protected $fillable = [
        'id',
        'title',
        'size',
        'type',
        'position',
        'obligatory',
        'is_numeric',
        'uuid_formula',
    ];

    public function sections()
    {
        return $this->belongsToMany(TBSectionRiskAnalysisModel::class, 'sections_ar_questions_ar_pivote');
    }

    public function dataQuestions()
    {
        return $this->belongsToMany(TBDataQuestionRiskAnalysisModel::class, 'questions_ar_data_questions_ar_pivote', 'question_id', 'dataquestion_id');
    }

    public function getFormula()
    {
        return $this->hasOne(TBFormulaRiskAnalysisModel::class, 'question_id', 'id');
    }
}
