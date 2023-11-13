<?php

namespace App\Models\Escuela;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Platform extends Model
{
    use HasFactory, ClearsResponseCache;
    use SoftDeletes;

    protected $guarded = ['id'];

    //Relacion uno a muchos
    public function lessons()
    {
        return $this->hasMany('App\Models\Lesson');
    }
}
