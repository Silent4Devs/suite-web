<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TBRiskAnalysis_ScalesArModel extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'risk_analysis_scales_ar_pivote';
    protected $fillable = [
        'id',
        'risk_analysis_id',
        'valor_min',
        'valor_max',
    ];

    // public function template()
    // {
    //     return $this->belongsTo(TBTemplateAnalisisRiesgoModel::class, 'template_id');
    // }

    // public function scales()
    // {
    //     return $this->hasMany(TBEscalaAnalisisRiesgoModel::class, 'min_max_id', 'id')->orderBy('id', 'asc');
    // }
}
