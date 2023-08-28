<?php

namespace App\Models\Escuela;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Description extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    //relacion uno a uno inversa

    public function lesson()
    {
        return $this->belongsTo('App\Models\Lesson');
    }
}
