<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TBDataQuestionRiskAnalysisModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $table = 'data_questions_risk_analysis';

    protected $fillable = [
        'id',
        'minimum',
        'maximum',
        'title',
        'name',
        'status',
        'url',
        'catalog',
        'value',
    ];

    public function questions()
    {
        return $this->belongsToMany(TBQuestionRiskAnalysisModel::class, 'questions_ar_data_questions_ar_pivote');
    }
}
