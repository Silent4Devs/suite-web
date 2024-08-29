<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TBSectionTemplateAr_QuestionTemplateArModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $table = 'secciones_templates_ar_questions_templates_ar_pivote';

    protected $fillable = [
        'id',
        'section_id',
        'question_id',
    ];
}
