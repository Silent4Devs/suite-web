<?php

namespace App\Models\Escuela;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuariosCursos extends Model
{
    use ClearsResponseCache, HasFactory;

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

    public function cursos()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
