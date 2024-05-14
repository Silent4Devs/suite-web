<?php

namespace App\Models\Escuela\Instructor;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Answer extends Model implements Auditable
{
    use ClearsResponseCache, HasFactory;
    use \OwenIt\Auditing\Auditable;
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
