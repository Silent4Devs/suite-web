<?php

namespace App\Models\escuela;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Evaluation extends Model
{
    use HasFactory;
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
        return $this->hasMany('App\Models\UserEvaluation');
    }

    public function getCompletedAttribute()
    {
        return $this->users->contains(auth()->user()->id);
    }
};
