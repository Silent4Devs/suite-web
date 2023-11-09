<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LeccionRecurso extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

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
