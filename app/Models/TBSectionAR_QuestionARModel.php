<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TBSectionAR_QuestionARModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $table = 'sections_ar_questions_ar_pivote';

    protected $fillable = [
        'id',
        'section_id',
        'question_id',
    ];
}
