<?php

namespace App\Models\Escuela;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lesson extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];


    // Funcion para indicar a que usuario permanece el avance del curso
    public function getCompletedAttribute()
    {
        return $this->users->contains(auth()->user()->id);
    }
    //Relacion uno a uno

    public function description()
    {
        return $this->hasOne('App\Models\Escuela\Description');
    }

    //Relacion uno a muchos inversa
    public function section()
    {
        return $this->belongsTo('App\Models\Escuela\Section');
    }

    public function platform()
    {
        return $this->belongsTo('App\Models\Escuela\Platform');
    }

    //Relacion muchos a muchos
    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }

    //Relacion uno a uno polimorfica

    public function resource()
    {
        return $this->morphOne('App\Models\Escuela\Resource', 'resourceable');
    }

    //Relacion uno a muchos polimorfica

    public function comments()
    {
        return $this->morphMany('App\Models\Escuela\Comment', 'commentable');
    }

    public function reactions()
    {
        return $this->morphMany('App\Models\Escuela\Reaction', 'reactionable');
    }
}
