<?php

namespace App\Models\Escuela;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Goal extends Model
{
    use ClearsResponseCache, HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    //Relacion uno a muchos inversa
    public function course()
    {
        return $this->belongsTo('App\Models\Course');
    }
}
