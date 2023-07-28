<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class LeccionRecurso extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'lecciones_recursos';

    protected $fillable = [
        'name',
        'url',
        'iframe',
        'seccion_id',
    ];

    public function seccion()
    {
        return $this->belongsTo(SeccionRecurso::class, 'seccion_id', 'id');
    }
}
