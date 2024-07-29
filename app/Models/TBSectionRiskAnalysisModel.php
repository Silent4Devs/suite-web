<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TBSectionRiskAnalysisModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $table = 'sections_risk_analysis';

    protected $fillable = [
        'id',
        'title',
        'risk_analysis_id',
        'position',
    ];

    public function questions()
    {
        return $this->belongsToMany(TBQuestionRiskAnalysisModel::class, 'sections_ar_questions_ar_pivote', 'section_id', 'question_id')->orderBy('position');
    }
}
