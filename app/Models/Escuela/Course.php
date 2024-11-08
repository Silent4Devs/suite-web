<?php

namespace App\Models\Escuela;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use OwenIt\Auditing\Contracts\Auditable;

class Course extends Model implements Auditable
{
    use ClearsResponseCache, SoftDeletes;
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $guarded = ['id', 'status'];

    protected $table = 'courses';

    protected $withCount = ['students', 'reviews'];

    protected $append = ['sections_order', 'rating', 'last_finished_lesson', 'certificado_ruta'];

    const BORRADOR = 1;

    const REVISION = 2;

    const PUBLICADO = 3;

    const CERRADO = 4;

    //query redis cache
    public static function getAll()
    {
        return Cache::remember('Courses:courses_all', 3600 * 7, function () {
            return self::with('sections.lessons', 'lessons', 'instructor')->get();
        });
    }

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

    public function getSectionsOrderAttribute()
    {
        if ($this->order_section) {
            $sections = $this->order_section;
            $string = str_replace('"', '', $sections);
            $string = str_replace('seccion-', '', $sections);
            $array = explode(',', $string);
            $sectionsRegisters = collect();
            foreach ($array as $section) {
                $sectionConsult = Section::find($section);
                if (isset($sectionConsult)) {
                    $sectionsRegisters->push($sectionConsult);
                }
            }

            $querys_unidos = $sectionsRegisters->merge($this->sections)->unique();

            return $querys_unidos;
        } else {
            $secciones = $this->sections;

            return $secciones;
        }
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
        return $this->hasMany('App\Models\Escuela\Section')->orderBy('created_at', 'asc');
    }

    //Relacion uno a muchos inversa
    public function teacher()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function instructor()
    {
        return $this->belongsTo('App\Models\User', 'empleado_id')->select('id', 'name', 'email', 'empleado_id', 'n_empleado')->with('empleado:id,name,email,area_id,puesto_id,foto,n_empleado');
    }

    public function user()
    {

        return $this->belongsTo('App\Models\User', 'empleado_id')->select('id', 'name', 'email', 'empleado_id', 'n_empleado');
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

    public function getLastFinishedLessonAttribute()
    {
        foreach ($this->sections_order as $secciones_lecciones) {
            foreach ($secciones_lecciones->lessons as $lesson) {
                if (! $lesson->completed) {
                    // dd($lesson);
                    return $lesson;
                    // break;
                }
            }
        }

        return null;
    }

    public function getCertificadoRutaAttribute() {
        if ($this->certificado) {
            return asset('img/escuela/certificaciones/certificado' . $this->certificado . '.png');
        }else{
            return null;
        }
    }

    public function getFirmaInstructorRutaAttribute() {
        if ($this->firma_instructor) {
            return asset('storage/cursos/firmas-instructores/' . $this->firma_instructor);
        }else{
            return null;
        }
    }
}
