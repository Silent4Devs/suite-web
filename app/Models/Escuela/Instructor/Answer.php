<?php

namespace App\Models\Escuela\Instructor;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Answer extends Model
{
    use HasFactory, ClearsResponseCache;
    use SoftDeletes;

    protected $table = 'answers';

    protected $fillable = [
        'answer',
        'is_correct',
        'question_id',
    ];

    public function useranswer()
    {
        return $this->hasMany('App\Models\UserAnswer');
    }
}
