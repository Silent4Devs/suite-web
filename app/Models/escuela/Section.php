<?php

namespace App\Models\escuela;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    //Relacion uno a muchos

    public function lessons()
    {
        return $this->hasMany('App\Models\Lesson');
    }


    //Relacion uno a muchos inversa
    public function course()
    {
        return $this->belongsTo('App\Models\Course');
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class, 'section_id', 'id');
    }
}
