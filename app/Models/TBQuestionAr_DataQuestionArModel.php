<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TBQuestionAr_DataQuestionArModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $table = 'questions_ar_data_questions_ar_pivote';

    protected $fillable = [
        'id',
        'question_id',
        'dataquestion_id',
    ];
}
