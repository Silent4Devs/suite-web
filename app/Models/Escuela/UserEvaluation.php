<?php

namespace App\Models\Escuela;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class UserEvaluation extends Model implements Auditable
{
    use ClearsResponseCache, HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'user_evaluations';

    protected $casts = [
        'score' => 'double', // o 'double' según tus necesidades
    ];

    protected $fillable = [
        'completed',
        'user_id',
        'evaluation_id',
        'score',
        'quiz_size',
        'approved',
    ];

    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }

    public function evaluations()
    {
        return $this->belongsToMany('App\Models\Evaluation');
    }

    public function userAnswers()
    {
        return $this->hasMany(UserAnswer::class, 'user_evaluation_id');
    }
}
