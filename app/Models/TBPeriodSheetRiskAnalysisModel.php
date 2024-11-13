<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TBPeriodSheetRiskAnalysisModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $table = 'period_sheet_risk_analysis_pivote';

    protected $fillable = [
        'id',
        'period_id',
        'sheet_id',
        'initial_risk',
        'residual_risk',
        'initial_coordinate_y',
        'initial_coordinate_x',
        'residual_coordinate_y',
        'residual_coordinate_x',
    ];

    public function sheet()
    {
        return $this->belongsTo(TBSheetRiskAnalysisModel::class, 'sheet_id');
    }
}
