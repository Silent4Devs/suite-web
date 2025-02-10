<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RiskAnalysis extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $table = 'risk_analysis_general';

    protected $fillable = [
        'id',
        'name',
        'fecha',
        'elaboro_id',
        'norma_id',
        'template_id',
    ];
}
