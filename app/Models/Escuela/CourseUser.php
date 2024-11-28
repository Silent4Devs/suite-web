<?php

namespace App\Models\Escuela;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class CourseUser extends Model implements Auditable
{
    use ClearsResponseCache, HasFactory;
    use \OwenIt\Auditing\Auditable;

    // use SoftDeletes;
    protected $table = 'course_user';

    protected $fillable = [
        // 'course_id',
        'user_id',
        'course_id',

    ];

    public function usuarios()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function curso()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function getCompletadoAttribute()
    {
        $sections = Section::where('course_id', $this->course_id)->get();

        $evaluaciones = Evaluation::getAll()->where('course_id', $this->course_id);

        $i = 0;
        $i_less = 0;

        foreach ($sections as $section) {
            foreach ($section->lessons as $lesson) {
                if ($lesson->completed) {
                    $i++;
                }
                $i_less++;
            }
        }

        $ids = $evaluaciones->pluck('id');
        $results = UserEvaluation::where('user_id', $this->user_id)->where('completed', true)->whereIn('evaluation_id', $ids)->count();
        $i = $i + $results;

        //calcular el porcentaje de la
        $advance = ($i * 100) / ($i_less + $evaluaciones->count());

        return round($advance, 2);
    }
}
