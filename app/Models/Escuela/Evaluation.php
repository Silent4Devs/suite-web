<?php

namespace App\Models\Escuela;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use App\Models\Escuela\Instructor\Question;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Evaluation extends Model
{
    use HasFactory, ClearsResponseCache;
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
