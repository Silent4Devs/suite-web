<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TBSettingsTemplateAR_TBQuestionTemplateARModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $table = 'settings_template_ar_questions_templates_ar_pivote_table';

    protected $fillable = [
        'id',
        'template_id',
        'question_id',
        'is_show',
    ];

    public function question()
    {
        return $this->belongsTo(TBQuestionTemplateAnalisisRiesgoModel::class, 'question_id');
    }
}
