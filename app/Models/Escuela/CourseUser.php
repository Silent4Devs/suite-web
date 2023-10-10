<?php

namespace App\Models\Escuela;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseUser extends Model
{
    use HasFactory;
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
