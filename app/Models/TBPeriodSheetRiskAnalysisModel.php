<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TBPeriodSheetRiskAnalysisModel extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'period_sheet_risk_analysis_pivote';

    protected $fillable = [
        'id',
        'period_id',
        'sheet_id',
    ];

    public function sheet()
    {
        return $this->belongsTo(TBSheetRiskAnalysisModel::class, 'sheet_id');
    }
}
