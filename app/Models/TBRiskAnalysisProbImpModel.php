<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TBRiskAnalysisProbImpModel extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'prob_imp_risk_analysis';

    protected $fillable = [
        'id',
        'nombre',
        'valor',
        'color',
        'min_max_id',
    ];
}
