<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TBAnswerSheetRiskAnalysisModel extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'answers_sheet_risk_analysis';

    protected $fillable = [
        'id',
        'question_id',
        'value',
    ];

    public function questionR()
    {
        return $this->hasOne(TBQuestionRiskAnalysisModel::class, 'id');
    }
}
