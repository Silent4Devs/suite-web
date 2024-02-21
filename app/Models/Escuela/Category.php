<?php

namespace App\Models\Escuela;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use ClearsResponseCache, HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    //Relacion uno a muchos
    public function courses()
    {
        return $this->hasMany('App\Models\Course');
    }
}
