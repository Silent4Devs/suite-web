<?php

namespace App\Models\Escuela;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Description extends Model
{
    use HasFactory, ClearsResponseCache;
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $fillable = [
        // 'course_id',
        'name',

    ];

    //relacion uno a uno inversa

    public function lesson()
    {
        return $this->belongsTo('App\Models\Lesson');
    }
}
