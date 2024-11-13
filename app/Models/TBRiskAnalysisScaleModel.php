<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TBRiskAnalysisScaleModel extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'scales_risk_analysis';

    protected $fillable = [
        'id',
        'nombre',
        'valor',
        'color',
        'riesgo_aceptable',
        'min_max_id',
    ];
}
