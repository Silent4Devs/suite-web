<?php

namespace App\Models\Escuela\Instructor;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Question extends Model implements Auditable
{
    use ClearsResponseCache, HasFactory;
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
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
