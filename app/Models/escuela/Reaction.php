<?php

namespace App\Models\escuela;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reaction extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    const LIKE = 1;
    const DISLIKE = 2;


    //relacion uno a muchos inversa

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }


    public function reactionable()
    {
        return $this->morphTo();
    }
}
