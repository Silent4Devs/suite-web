<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TBPeriodRiskAnalysisModel extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'period_risk_analysis';

    protected $fillable = [
        'id',
        'risk_analysis_id',
        'status',
        'name',
        'start',
        'end',
    ];
}
