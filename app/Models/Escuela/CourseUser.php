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

    // public function cursos()
    // {
    //     return $this->belongsTo(Course::class, 'course_id');
    // }
}
