<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TBSectionTemplateAnalisisRiesgoModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $table = 'sections_templates_analisis_riesgo';

    protected $fillable = [
        'id',
        'title',
        'template_id',
        'position',
    ];

    public function questions()
    {
        return $this->belongsToMany(TBQuestionTemplateAnalisisRiesgoModel::class, 'secciones_templates_ar_questions_templates_ar_pivote', 'section_id', 'question_id');
    }
}
