<?php

namespace App\Models\Escuela;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Audience extends Model
{
    use HasFactory, ClearsResponseCache;
    use SoftDeletes;

    protected $guarded = ['id'];

    //Relacion uno a muchos inversa
    public function course()
    {
        return $this->belongsTo('App\Models\Course');
    }
}
