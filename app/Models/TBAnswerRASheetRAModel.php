<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TBAnswerRASheetRAModel extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'answers_sheet_risk_analysis_pivote';

    protected $fillable = [
        'id',
        'sheet_id',
        'answer_id',
    ];

    public function answer()
    {
        return $this->belongsTo(TBAnswerSheetRiskAnalysisModel::class, 'answer_id');
    }
}
