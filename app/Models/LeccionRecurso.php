<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class LeccionRecurso extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory, SoftDeletes;

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
