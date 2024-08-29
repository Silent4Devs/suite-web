<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TBQuestionTemplateAnalisisRiesgoModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $table = 'questions_templates_analisis_riesgo';

    protected $fillable = [
        'id',
        'title',
        'size',
        'type',
        'position',
        'obligatory',
        'is_numeric',
    ];

    public function sections()
    {
        return $this->belongsToMany(TBSectionTemplateAnalisisRiesgoModel::class, 'secciones_templates_ar_questions_templates_ar_pivote');
    }

    public function dataQuestions()
    {
        return $this->belongsToMany(TBDataQuestionTemplateAnalisisRiesgoModel::class, 'questions_templates_ar_data_questions_templates_ar_pivote', 'question_id', 'dataquestion_id');
    }
}
