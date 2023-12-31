<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class SeccionRecurso extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory, SoftDeletes;

    protected $table = 'lecciones_recursos';

    protected $fillable = [
        'name',
        'recurso_id',
    ];

    public function lecciones()
    {
        return $this->hasMany(LeccionRecurso::class, 'seccion_id', 'id');
    }

    public function capacitacion()
    {
        return $this->belongsTo(Recurso::class, 'recurso_id', 'id');
    }
}
