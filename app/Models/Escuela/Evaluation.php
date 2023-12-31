<?php

namespace App\Models\Escuela;

use App\Models\Escuela\Instructor\Question;
use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Evaluation extends Model
{
    use ClearsResponseCache, HasFactory;
    use SoftDeletes;

    protected $table = 'evaluations';

    protected $guarded = ['id'];

    public function questions()
    {
        return $this->hasMany(Question::class, 'evaluation_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function users()
    {
        return $this->hasMany('App\Models\Escuela\UserEvaluation');
    }

    public function getCompletedAttribute()
    {
        return $this->users->contains(auth()->user()->id);
    }
}
