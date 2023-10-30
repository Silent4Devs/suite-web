<?php

namespace App\Models\RH;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ObjetivoCalificacion extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

    protected $table = 'ev360_objetivos_calificaciones';

    protected $guarded = ['id'];
}
