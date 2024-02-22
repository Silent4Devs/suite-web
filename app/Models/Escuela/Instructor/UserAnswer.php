<?php

namespace App\Models\Escuela\Instructor;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
class UserAnswer extends Model implements Auditable
{
    use ClearsResponseCache, SoftDeletes;
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    protected $table = 'user_answers';

    protected $fillable = [
        'user_id',
        'answer_id',
        'user_evaluation_id',
        'is_correct',
        'question_id',
        'evaluation_id',
    ];

    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }

    public function answer()
    {
        return $this->belongsTo(Answer::class, 'answer_id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

    public function userEvaluation()
    {
        return $this->belongsTo(UserEvaluation::class, 'user_evaluation_id');
    }

    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class, 'evaluation_id');
    }

    public function scopeQuestions($query, $evaluationId, $user = null)
    {
        if ($user == null) {
            return $query->where('user_id', auth()->id())->where('evaluation_id', $evaluationId);
        }

        return $query->where('user_id', $user)->where('evaluation_id', $evaluationId);
    }
}
