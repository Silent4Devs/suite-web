<?php

namespace App\Models\Escuela;

use App\Models\User;
use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class UsuariosCursos extends Model implements Auditable
{
    use ClearsResponseCache, HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'course_user';

    protected $fillable = [
        'user_id',
        'course_id',
        'last_review',

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
