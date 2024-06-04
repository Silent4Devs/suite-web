<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TBDataQuestionTemplateAnalisisRiesgoModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $table = 'data_questions_templates_analisis_riesgo';

    protected $fillable = [
        'id',
        'minimum',
        'maximum',
        'title',
        'name',
        'status',
        'url',
        'catalog',
        'value',
    ];

    public function questions()
    {
        return $this->belongsToMany(TBQuestionTemplateAnalisisRiesgoModel::class, 'questions_templates_ar_data_questions_templates_ar_pivote');
    }
}
