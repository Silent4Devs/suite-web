<?php

namespace App\Models\escuela\Instructor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Model
{
    use HasFactory;
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
