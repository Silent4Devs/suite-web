<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TBFormulaTemplateAnalisisRiesgoModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $table = 'formulas_template_analisis_riesgos';

    protected $fillable = [
        'id',
        'title',
        'formula',
        'riesgo',
        'template_id',
        'section_id',
        'question_id',
    ];
}
