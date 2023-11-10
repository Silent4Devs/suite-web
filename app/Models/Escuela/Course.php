<?php

namespace App\Models\Escuela;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use ClearsResponseCache, SoftDeletes;
    use HasFactory;

    protected $guarded = ['id', 'status'];

    protected $withCount = ['students', 'reviews'];

    const BORRADOR = 1;

    const REVISION = 2;

    const PUBLICADO = 3;

    // Calificación del curso
    public function getRatingAttribute()
    {
        if ($this->reviews_count) {
            return round($this->reviews->avg('rating'), 2);
        } else {
            return 0;
        }
    }

    //Query Scopes

    public function scopeCategory($query, $category_id)
    {
        if ($category_id) {
            return $query->where('category_id', $category_id);
        }
    }

    public function scopeLevel($query, $level_id)
    {
        if ($level_id) {
            return $query->where('level_id', $level_id);
        }
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    //Relacion uno a muchos

    public function reviews()
    {
        return $this->hasMany('App\Models\Escuela\Review');
    }

    public function requirements()
    {
        return $this->hasMany('App\Models\Escuela\Requirement');
    }

    public function goals()
    {
        return $this->hasMany('App\Models\Escuela\Goal');
    }

    public function audiences()
    {
        return $this->hasMany('App\Models\Escuela\Audience');
    }

    public function sections()
    {
        return $this->hasMany('App\Models\Escuela\Section');
    }

    //Relacion uno a muchos inversa
    public function teacher()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function level()
    {
        return $this->belongsTo('App\Models\Escuela\Level');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Escuela\Category');
    }

    public function price()
    {
        return $this->belongsTo('App\Models\Escuela\Level');
    }

    public function usuarioscursos()
    {
        return $this->hasMany('App\Models\Escuela\UsuariosCursos');
    }

    //Relacion muchos a muchos
    public function students()
    {
        return $this->belongsToMany('App\Models\User');
    }

    //Relacion uno a uno polimorfica

    public function image()
    {
        return $this->morphOne('App\Models\Escuela\Image', 'imageable');
    }

    //Relacion hasManyThrough
    // Relación entre course y lessons
    public function lessons()
    {
        return $this->hasManyThrough('App\Models\Escuela\Lesson', 'App\Models\Escuela\Section');
    }
}
