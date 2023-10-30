<?php

namespace App\Models\Escuela\Instructor;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory, ClearsResponseCache;
    use SoftDeletes;

    protected $table = 'questions';

    protected $fillable = [
        'question',
        'explanation',
        'is_active',
        'evaluation_id',
    ];

    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class, 'evaluation_id');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class, 'question_id');
    }
}
