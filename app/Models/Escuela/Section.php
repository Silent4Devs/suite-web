<?php

namespace App\Models\Escuela;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Section extends Model implements Auditable
{
    use ClearsResponseCache, HasFactory;
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    protected $guarded = ['id'];

    //Relacion uno a muchos

    public function lessons()
    {
        return $this->hasMany('App\Models\Escuela\Lesson')->orderBy('created_at', 'asc');
    }

    //Relacion uno a muchos inversa
    public function course()
    {
        return $this->belongsTo('App\Models\Escuela\Course');
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class, 'section_id', 'id');
    }
}
