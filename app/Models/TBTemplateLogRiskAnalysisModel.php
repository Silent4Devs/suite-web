<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TBTemplateLogRiskAnalysisModel extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'template_logs_analisis_riesgos';

    protected $fillable = [
        'id',
        'step',
        'action',
        'empleado_id',
        'template_id',
    ];
}
